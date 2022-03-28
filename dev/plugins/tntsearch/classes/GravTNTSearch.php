<?php
namespace Grav\Plugin\TNTSearch;

use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Language\Language;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Pages;
use Grav\Common\Twig\Twig;
use Grav\Common\Uri;
use Grav\Common\Yaml;
use Grav\Common\Page\Collection;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;
use TeamTNT\TNTSearch\Exceptions\IndexNotFoundException;
use TeamTNT\TNTSearch\TNTSearch;

class GravTNTSearch
{
    /** @var TNTSearch */
    public $tnt;
    /** @var array */
    protected $options;
    /** @var string[] */
    protected $bool_characters = ['-', '(', ')', 'or'];
    /** @var string */
    protected $index = 'grav.index';
    /** @var false|string */
    protected $language;

    /**
     * GravTNTSearch constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        /** @var Config $config */
        $config = Grav::instance()['config'];

        /** @var UniformResourceLocator $locator */
        $locator = Grav::instance()['locator'];

        $search_type = $config->get('plugins.tntsearch.search_type', 'auto');
        $stemmer = $config->get('plugins.tntsearch.stemmer', 'default');
        $limit = $config->get('plugins.tntsearch.limit', 20);
        $snippet = $config->get('plugins.tntsearch.snippet', 300);
        $data_path = $locator->findResource('user://data', true) . '/tntsearch';

        /** @var Language $language */
        $language = Grav::instance()['language'];

        if ($language->enabled()) {
            $active = $language->getActive();
            $default = $language->getDefault();
            $this->language = $active ?: $default;
            $this->index =  $this->language . '.index';
        }

        if (!file_exists($data_path)) {
            mkdir($data_path);
        }

        $defaults = [
            'json' => false,
            'search_type' => $search_type,
            'stemmer' => $stemmer,
            'limit' => $limit,
            'as_you_type' => true,
            'snippet' => $snippet,
            'phrases' => true,
        ];

        $this->options = array_replace($defaults, $options);
        $this->tnt = new TNTSearch();
        $this->tnt->loadConfig(
            [
                'storage'   => $data_path,
                'driver'    => 'sqlite',
                'charset'   => 'utf8'
            ]
        );
    }

    /**
     * @param string $query
     * @return object|string
     * @throws IndexNotFoundException
     */
    public function search($query)
    {
        /** @var Uri $uri */
        $uri = Grav::instance()['uri'];
        $type = $uri->query('search_type');
        $this->tnt->selectIndex($this->index);
        $this->tnt->asYouType = $this->options['as_you_type'];

        if (isset($this->options['fuzzy']) && $this->options['fuzzy']) {
            $this->tnt->fuzziness = true;
        }

        $limit = (int)$this->options['limit'];
        $type = $type ?? $this->options['search_type'];

        // TODO: Multiword parameter has been removed from $tnt->search(), please check if this works
        $multiword = null;
        if (isset($this->options['phrases']) && $this->options['phrases']) {
            if (strlen($query) > 2) {
                if ($query[0] === '"' && $query[strlen($query) - 1] === '"') {
                    $multiword = substr($query, 1, -1);
                    $type = 'basic';
                    $query = $multiword;
                }
            }
        }


        switch ($type) {
            case 'basic':
                $results = $this->tnt->search($query, $limit);
                break;
            case 'boolean':
                $results = $this->tnt->searchBoolean($query, $limit);
                break;
            case 'default':
            case 'auto':
            default:
                $guess = 'search';
                foreach ($this->bool_characters as $char) {
                    if (strpos($query, $char) !== false) {
                        $guess = 'searchBoolean';
                        break;
                    }
                }

                $results = $this->tnt->{$guess}($query, $limit);
        }

        return $this->processResults($results, $query);
    }

    /**
     * @param array $res
     * @param string $query
     * @return object|string
     */
    protected function processResults($res, $query)
    {
        $data = new \stdClass();
        $data->number_of_hits = $res['hits'] ?? 0;
        $data->execution_time = $res['execution_time'];

        /** @var Pages $pages */
        $pages = Grav::instance()['pages'];

        $counter = 0;
        foreach ($res['ids'] as $path) {
            if ($counter++ > $this->options['limit']) {
                break;
            }

            $page = $pages->find($path);

            if ($page) {
                $event = new Event(
                    [
                        'page' => $page,
                        'query' => $query,
                        'options' => $this->options,
                        'fields' => $data,
                        'gtnt' => $this
                    ]
                );
                Grav::instance()->fireEvent('onTNTSearchQuery', $event);
            }
        }

        if ($this->options['json']) {
            return json_encode($data, JSON_PRETTY_PRINT) ?: '';
        }

        return $data;
    }

    /**
     * @param PageInterface $page
     * @return string
     */
    public static function getCleanContent($page)
    {
        $grav = Grav::instance();
        $activePage = $grav['page'];

        // Set active page in grav to the one we are currently processing.
        unset($grav['page']);
        $grav['page'] = $page;

        /** @var Twig $twig */
        $twig = $grav['twig'];
        $header = $page->header();

        // @phpstan-ignore-next-line
        if (isset($header->tntsearch['template'])) {
            $processed_page = $twig->processTemplate($header->tntsearch['template'] . '.html.twig', ['page' => $page]);
            $content = $processed_page;
        } else {
            $content = $page->content();
        }

        $content = strip_tags($content);
        $content = preg_replace(['/[ \t]+/', '/\s*$^\s*/m'], [' ', "\n"], $content) ?? $content;

        // Restore active page in Grav.
        unset($grav['page']);
        $grav['page'] = $activePage;

        return $content;
    }

    /**
     * @return void
     */
    public function createIndex()
    {
        $this->tnt->setDatabaseHandle(new GravConnector);
        $indexer = $this->tnt->createIndex($this->index);

        // Set the stemmer language if set
        if ($this->options['stemmer'] !== 'default') {
            $indexer->setLanguage($this->options['stemmer']);
        }

        $indexer->run();
    }

    /**
     * @return void
     * @throws IndexNotFoundException
     */
    public function selectIndex()
    {
        $this->tnt->selectIndex($this->index);
    }

    /**
     * @param object $object
     * @return void
     */
    public function deleteIndex($object)
    {
        if (!$object instanceof Page) {
            return;
        }

        $this->tnt->setDatabaseHandle(new GravConnector);
        try {
            $this->tnt->selectIndex($this->index);
        } catch (IndexNotFoundException $e) {
            return;
        }

        $indexer = $this->tnt->getIndex();

        // Delete existing if it exists
        $indexer->delete($object->route());
    }

    /**
     * @param object $object
     * @return void
     */
    public function updateIndex($object)
    {
        if (!$object instanceof Page) {
            return;
        }

        $this->tnt->setDatabaseHandle(new GravConnector);

        try {
            $this->tnt->selectIndex($this->index);
        } catch (IndexNotFoundException $e) {
            return;
        }

        $indexer = $this->tnt->getIndex();

        // Delete existing if it exists
        $indexer->delete($object->route());

        $filter = Grav::instance()['config']->get('plugins.tntsearch.filter');
        if ($filter && array_key_exists('items', $filter)) {

            if (is_string($filter['items'])) {
                $filter['items'] = Yaml::parse($filter['items']);
            }

            $apage = new Page;
            /** @var Collection $collection */
            $collection = $apage->collection($filter, false);

            $path = $object->path();
            if ($path && array_key_exists($path, $collection->toArray())) {
                $fields = $this->indexPageData($object);
                $document = (array) $fields;

                // Insert document
                $indexer->insert($document);
            }
        }
    }

    /**
     * @param PageInterface $page
     * @return object
     */
    public function indexPageData($page)
    {
        $header = (array) $page->header();
        $redirect = (bool) $page->redirect();

        if (!$page->published()) {
            throw new \RuntimeException('not published...');
        }
        if (!$page->routable()) {
            throw new \RuntimeException('not routable...');
        }
        if ($redirect || (isset($header['tntsearch']['index']) && $header['tntsearch']['index'] === false )) {
            throw new \RuntimeException('redirect only...');
        }

        $route = $page->route();

        $fields = new \stdClass();
        $fields->id = $route;
        $fields->name = $page->title();
        $fields->content = static::getCleanContent($page);

        Grav::instance()->fireEvent('onTNTSearchIndex', new Event(['page' => $page, 'fields' => $fields]));

        return $fields;
    }
}

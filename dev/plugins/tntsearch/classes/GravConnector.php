<?php
namespace Grav\Plugin\TNTSearch;

use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Yaml;
use Grav\Common\Page\Page;
use Grav\Plugin\TNTSearchPlugin;
use PDO;

class GravConnector extends PDO
{
    public function __construct()
    {
    }

    /**
     * @param int $attribute
     * @return bool
     */
    public function getAttribute($attribute): bool
    {
        return false;
    }

    /***
     * @param string $statement
     * @param int|null $fetch_style
     * @param mixed ...$extra
     * @return GravResultObject
     */
    public function query(string $statement, ?int $fetch_style = null, ...$extra): GravResultObject
    {
        $counter = 0;
        $results = [];

        /** @var Config $config */
        $config = Grav::instance()['config'];
        $filter = $config->get('plugins.tntsearch.filter');
        $default_process = $config->get('plugins.tntsearch.index_page_by_default');
        $gtnt = TNTSearchPlugin::getSearchObjectType();


        if ($filter && array_key_exists('items', $filter)) {

            if (is_string($filter['items'])) {
                $filter['items'] = Yaml::parse($filter['items']);
            }

            $page = new Page;
            $collection = $page->collection($filter, false);
        } else {
            $collection = Grav::instance()['pages']->all();
            $collection->published()->routable();
        }

        foreach ($collection as $page) {
            $counter++;
            $process = $default_process;
            $header = $page->header();
            $url = $page->url();

            if (isset($header->tntsearch['process'])) {
                $process = $header->tntsearch['process'];
            }

            // Only process what's configured
            if (!$process) {
                echo("Skipped {$counter} {$url}\n");
                continue;
            }

            try {
                $fields = $gtnt->indexPageData($page);
                $results[] = (array) $fields;
                echo("Added   {$counter} {$url}\n");
            } catch (\Exception $e) {
                echo("Skipped {$counter} {$url} - {$e->getMessage()}\n");
                continue;
            }
        }

        return new GravResultObject($results);
    }

}


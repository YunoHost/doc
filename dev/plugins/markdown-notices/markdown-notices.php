<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class MarkdownNoticesPlugin extends Plugin
{
    protected $base_classes;
    protected $level_classes;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100001],
            ],
            'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
            'onTwigSiteVariables'   => ['onTwigSiteVariables', 0]
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload()
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onMarkdownInitialized(Event $event)
    {
        $markdown = $event['markdown'];

        $markdown->addBlockType('!', 'Notices', true, false);

        $markdown->blockNotices = function($Line) {

            $this->level_classes = $this->config->get('plugins.markdown-notices.level_classes');
            $this->base_classes  = $this->config->get('plugins.markdown-notices.base_classes');

            if (preg_match('/^(!{1,'.count($this->level_classes).'}) (.*)/', $Line['text'], $matches))
            {
                $level = strlen($matches[1]) - 1;

                $text = $matches[2];
                $base_classes = (empty($this->base_classes)) ? '' : str_replace(',', ' ', $this->base_classes) . ' ';

                $Block = [
                    'element' => [
                        'name' => 'div',
                        'handler' => 'lines',
                        'attributes' => [
                            'class' => $base_classes . $this->level_classes[$level],
                        ],
                        'text' => (array) $text,
                    ],
                ];

                return $Block;
            }
        };

        $markdown->blockNoticesContinue = function($Line, array $Block) {
            if (isset($Block['interrupted']))
            {
                return;
            }

            if (preg_match('/^(!{1,'.count($this->level_classes).'}) ?(.*)/', $Line['text'], $matches))
            {
                $Block['element']['text'] []= $matches[2];

                return $Block;
            }
        };
    }

    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.markdown-notices.built_in_css')) {
            $this->grav['assets']
                ->add('plugin://markdown-notices/assets/notices.css');
        }
    }
}

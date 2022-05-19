<?php
/**
 * Presentation Plugin, Deckset addon
 *
 * PHP version 7
 *
 * @category   Extensions
 * @package    Grav
 * @subpackage PresentationDeckset
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation-deckset
 */
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\PresentationPlugin\API\DecksetParser;
use RocketTheme\Toolbox\Event\Event;

/**
 * Creates slides using Deckset-syntax
 *
 * Class PresentationDecksetPlugin
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation-deckset
 */
class PresentationDecksetPlugin extends Plugin
{
    /**
     * Register initial event
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     *
     * @param Event $event RocketTheme events
     *
     * @return void
     */
    public function onPluginsInitialized(Event $event)
    {
        if (
            $this->config->get('plugins.presentation.enabled') &&
            $this->config->get('plugins.presentation-deckset.enabled')
        ) {
            include_once __DIR__ . '/classes/DecksetParser.php';
        }
    }
}

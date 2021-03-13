<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use Grav\Plugin\ShortcodeManager;
use Grav\Theme\Learn4\Shortcodes\VersionShortcode;
use Pimple\Exception\UnknownIdentifierException;
use RocketTheme\Toolbox\Event\Event;

class Learn4 extends Theme
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onTwigPageVariables' => ['onTwigPageVariables', 0],
            'onTNTSearchQuery' => ['onTNTSearchQuery', 1000],
        ];
    }

    public function onTwigPageVariables()
    {
        $this->grav['twig']->twig_vars['grav_version'] = GRAV_VERSION;
    }

    public function onTNTSearchQuery(Event $e): void
    {
        $query = $this->grav['uri']->param('q');

        if ($query) {
            $page = $e['page'];
            $fields = $e['fields'];

            $fields->results[] = $page->route();
            $e->stopPropagation();
        }
    }

    public function onShortcodeHandlers(): void
    {
        /** @var ShortcodeManager $sc */
        $sc = $this->grav['shortcode'];
        $sc->registerAllShortcodes(__DIR__ . '/classes/Shortcodes');
    }

    public function onTwigInitialized(): void
    {
        $twig = $this->grav['twig'];

        $form_class_variables = [
//            'form_outer_classes' => 'form-horizontal',
            'form_button_outer_classes' => 'button-wrapper',
            'form_button_classes' => 'btn',
            'form_errors_classes' => '',
            'form_field_outer_classes' => 'form-group',
            'form_field_outer_label_classes' => 'form-label-wrapper',
            'form_field_label_classes' => 'form-label',
//            'form_field_outer_data_classes' => 'col-9',
            'form_field_input_classes' => 'form-input',
            'form_field_textarea_classes' => 'form-input',
            'form_field_select_classes' => 'form-select',
            'form_field_radio_classes' => 'form-radio',
            'form_field_checkbox_classes' => 'form-checkbox',
        ];

        $twig->twig_vars = array_merge($twig->twig_vars, $form_class_variables);

        $color = $this->grav['uri']->query('color');

        if (in_array($color, ['purple', 'green', 'blue', 'contrast'])) {
            setcookie("sidebar-pref", $color, 0, '/');
        } else {
            $color = filter_input(INPUT_COOKIE, 'sidebar-pref') ?: 'purple';
        }

        $twig->twig_vars['sidebar_color'] = "sidebar-$color";

    }

}

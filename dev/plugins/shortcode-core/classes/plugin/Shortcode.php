<?php

namespace Grav\Plugin\ShortcodeCore;

// Check if the new class has been autoloaded. If not, trigger deprecation error.
if (!class_exists(\Grav\Plugin\Shortcodes\Shortcode::class, false)) {
    @trigger_error(
        Shortcode::class . ' class is deprecated, use \\Grav\\Plugin\\Shortcodes\\Shortcode instead',
        E_USER_DEPRECATED
    );
}

// Create alias for the deprecated class.
class_alias(\Grav\Plugin\Shortcodes\Shortcode::class, Shortcode::class);

// Make sure that both IDE and composer knows about the deprecated class.
if (false) {
    /**
     * @deprecated 4.2.1 This was a bad idea, reverting back to the old class.
     */
    abstract class Shortcode extends \Grav\Plugin\Shortcodes\Shortcode
    {
    }
}
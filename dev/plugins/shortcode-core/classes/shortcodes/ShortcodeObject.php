<?php

namespace Grav\Plugin\Shortcodes;

// Check if the new class has been autoloaded. If not, trigger deprecation error.
if (!class_exists(\Grav\Plugin\ShortcodeCore\ShortcodeObject::class, false)) {
    @trigger_error(
        ShortcodeObject::class . ' class is deprecated, use \\Grav\\Plugin\\ShortcodeCore\\ShortcodeObject instead',
        E_USER_DEPRECATED
    );
}

// Create alias for the deprecated class.
class_alias(\Grav\Plugin\ShortcodeCore\ShortcodeObject::class, ShortcodeObject::class);

// Make sure that both IDE and composer knows about the deprecated class.
if (false) {
    /**
     * @deprecated 4.2.0 Use \Grav\Plugin\ShortcodeCore\ShortcodeObject instead
     */
    class ShortcodeObject extends \Grav\Plugin\ShortcodeCore\ShortcodeObject
    {
    }
}
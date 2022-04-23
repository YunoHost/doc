<?php

// This file is for older Grav versions (needed during plugin update).

@trigger_error(
     '\\Grav\\Plugin\\ShortcodeManager class is deprecated, use \\Grav\\Plugin\\ShortcodeCore\\ShortcodeManager instead',
    E_USER_DEPRECATED
);

if (!class_exists(\Grav\Plugin\ShortcodeCore\ShortcodeManager::class, false)) {
    require_once __DIR__ . '/plugin/ShortcodeManager.php';
}

// Create alias for the deprecated class.
class_alias(\Grav\Plugin\ShortcodeCore\ShortcodeManager::class, \Grav\Plugin\ShortcodeManager::class);
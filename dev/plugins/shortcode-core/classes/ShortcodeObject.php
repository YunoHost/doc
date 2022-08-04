<?php

// This file is for older Grav versions (needed during plugin update).

if (!class_exists(\Grav\Plugin\ShortcodeCore\ShortcodeObject::class, false)) {
    require_once __DIR__ . '/shortcodes/ShortcodeObject.php';
}
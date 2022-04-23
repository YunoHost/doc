<?php

// This file is for older Grav versions (needed during plugin update).

if (!class_exists(\Grav\Plugin\Shortcodes\Shortcode::class, false)) {
    require_once __DIR__ . '/shortcodes/Shortcode.php';
}

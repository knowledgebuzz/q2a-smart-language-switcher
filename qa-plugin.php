<?php

/*
    Plugin Name: Smart Language Switcher
    Plugin URI: https://unitedafrica.digital/q2a-language-selector
    Plugin Description: Dynamic native language switcher for Question2Answer. Automatically detects installed language packs with smart fallback detection, alphabetical sorting, caching, and per-user language memory.
    Plugin Version: 1.0.0
    Plugin Date: 2026-03-03
    Plugin Author: Davis
    Plugin Author URI: https://unitedafrica.digital/davis
    Plugin License: GPLv2
*/

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

qa_register_plugin_layer('qa-language-layer.php', 'Language Layer');

qa_register_plugin_module(
    'widget',
    'qa-language-widget.php',
    'qa_language_widget',
    'Language Switcher'
);

qa_register_plugin_module(
    'module',
    'qa-language-admin.php',
    'qa_language_admin',
    'Language Switcher Settings'
);

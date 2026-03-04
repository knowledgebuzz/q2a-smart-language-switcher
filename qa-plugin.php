<?php

/*
    Plugin Name: Smart Language Switcher
    Description: Dynamic language selector.
    Version: 1.0
    Author: Davis
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
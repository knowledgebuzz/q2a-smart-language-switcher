<?php

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

class qa_html_theme_layer extends qa_html_theme_base {

    function doctype() {

        // Manual selection
        if (isset($_GET['qlang']) && !empty($_GET['qlang'])) {

            $lang = preg_replace('/[^a-zA-Z0-9\-]/', '', $_GET['qlang']);

            if (is_dir(QA_LANG_DIR . '/' . $lang)) {

                setcookie('qls_lang', $lang, time() + (86400 * 30), '/');
                $_COOKIE['qls_lang'] = $lang;

                require_once QA_INCLUDE_DIR . 'app/options.php';
                qa_opt('site_language', $lang);
            }

            $url = strtok($_SERVER["REQUEST_URI"], '?');
            header("Location: " . $url);
            exit;
        }

        // Auto-detect (only if enabled)
        if (qa_opt('qls_auto_detect') && !isset($_COOKIE['qls_lang'])) {

            if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {

                $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

                foreach (scandir(QA_LANG_DIR) as $folder) {

                    if ($folder != '.' && $folder != '..') {

                        if (strtolower(substr($folder, 0, 2)) === strtolower($browserLang)) {

                            setcookie('qls_lang', $folder, time() + (86400 * 30), '/');
                            $_COOKIE['qls_lang'] = $folder;

                            require_once QA_INCLUDE_DIR . 'app/options.php';
                            qa_opt('site_language', $folder);

                            header("Location: " . $_SERVER['REQUEST_URI']);
                            exit;
                        }
                    }
                }
            }
        }

        parent::doctype();
    }

    function head_custom() {
        parent::head_custom();

        $current = qa_opt('site_language');
        $rtl_list = ['ar','arabic','fa','persian','ur','urdu'];

        foreach ($rtl_list as $rtl) {
            if (stripos($current, $rtl) !== false) {
                echo '<style>
                    html { direction: rtl; }
                    body { text-align: right; }
                </style>';
                break;
            }
        }
    }
}
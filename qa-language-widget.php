<?php

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

class qa_language_widget {

    function allow_template($template) {
        return true;
    }

    function allow_region($region) {
        return true;
    }

    function output_widget($region, $place, $themeobject, $template, $request, $qa_content) {

        $current = qa_opt('site_language');
        $langs = [];

        // Get language folders
        foreach (scandir(QA_LANG_DIR) as $folder) {
            if ($folder != '.' && $folder != '..' && is_dir(QA_LANG_DIR.'/'.$folder)) {
                $langs[$folder] = $folder;
            }
        }

        ksort($langs);

        echo '<div class="qls-wrapper">';
        echo '<span style="margin-right:6px;">🌍</span>';
        echo '<select onchange="if(this.value) window.location.href=this.value;">';

        // Show placeholder only if no language cookie
        if (!isset($_COOKIE['qls_lang'])) {
            echo '<option value="" selected disabled>Select Language</option>';
        }

        foreach ($langs as $code => $name) {

            list($display, $flag) = $this->detect_language($code);

            $selected = ($code == $current) ? 'selected' : '';

            echo '<option value="?qlang=' . htmlspecialchars($code) . '" ' . $selected . '>';
            echo $flag . ' ' . htmlspecialchars($display);
            echo '</option>';
        }

        echo '</select>';
        echo '</div>';
    }

    private function normalize($name) {
        return strtolower(str_replace(['-', '_', ' '], '', $name));
    }

    private function detect_language($folder) {

        $normalized = $this->normalize($folder);

        $map = [

    // ===== GLOBAL MAJOR LANGUAGES =====
    'english' => ['English', '🇬🇧'],
    'en' => ['English', '🇬🇧'],

    'spanish' => ['Spanish', '🇪🇸'],
    'es' => ['Spanish', '🇪🇸'],

    'french' => ['French', '🇫🇷'],
    'fr' => ['French', '🇫🇷'],

    'arabic' => ['Arabic', '🇸🇦'],
    'ar' => ['Arabic', '🇸🇦'],

    'chinese' => ['Chinese (Simplified)', '🇨🇳'],
    'zh' => ['Chinese (Simplified)', '🇨🇳'],
    'zhcn' => ['Chinese (Simplified)', '🇨🇳'],

    'traditionalchinese' => ['Chinese (Traditional)', '🇹🇼'],
    'zhtw' => ['Chinese (Traditional)', '🇹🇼'],

    'hindi' => ['Hindi', '🇮🇳'],
    'hi' => ['Hindi', '🇮🇳'],

    'portuguese' => ['Portuguese', '🇵🇹'],
    'pt' => ['Portuguese', '🇵🇹'],

    'russian' => ['Russian', '🇷🇺'],
    'ru' => ['Russian', '🇷🇺'],

    'german' => ['German', '🇩🇪'],
    'de' => ['German', '🇩🇪'],

    'japanese' => ['Japanese', '🇯🇵'],
    'ja' => ['Japanese', '🇯🇵'],

    'korean' => ['Korean', '🇰🇷'],
    'ko' => ['Korean', '🇰🇷'],

    'turkish' => ['Turkish', '🇹🇷'],
    'tr' => ['Turkish', '🇹🇷'],

    'italian' => ['Italian', '🇮🇹'],
    'it' => ['Italian', '🇮🇹'],

    'dutch' => ['Dutch', '🇳🇱'],
    'nl' => ['Dutch', '🇳🇱'],

    'persian' => ['Persian (Farsi)', '🇮🇷'],
    'fa' => ['Persian (Farsi)', '🇮🇷'],

    'urdu' => ['Urdu', '🇵🇰'],
    'ur' => ['Urdu', '🇵🇰'],

    // ===== AFRICAN PRIORITY LANGUAGES =====
    'swahili' => ['Swahili', '🇹🇿'],
    'kiswahili' => ['Swahili', '🇹🇿'],
    'sw' => ['Swahili', '🇹🇿'],

    'amharic' => ['Amharic', '🇪🇹'],
    'am' => ['Amharic', '🇪🇹'],

    'hausa' => ['Hausa', '🇳🇬'],
    'igbo' => ['Igbo', '🇳🇬'],
    'yoruba' => ['Yoruba', '🇳🇬'],

    'zulu' => ['Zulu', '🇿🇦'],
    'afrikaans' => ['Afrikaans', '🇿🇦'],

    'somali' => ['Somali', '🇸🇴'],

    // ===== SOUTH / SOUTHEAST ASIA =====
    'bengali' => ['Bengali', '🇧🇩'],
    'bn' => ['Bengali', '🇧🇩'],

    'tamil' => ['Tamil', '🇮🇳'],

    'thai' => ['Thai', '🇹🇭'],
    'vi' => ['Vietnamese', '🇻🇳'],
    'vietnamese' => ['Vietnamese', '🇻🇳'],

    'indonesian' => ['Indonesian', '🇮🇩'],
    'id' => ['Indonesian', '🇮🇩'],

    // ===== EUROPE FUTURE EXPANSION =====
    'polish' => ['Polish', '🇵🇱'],
    'pl' => ['Polish', '🇵🇱'],

    'ukrainian' => ['Ukrainian', '🇺🇦'],
    'uk' => ['Ukrainian', '🇺🇦'],

    'greek' => ['Greek', '🇬🇷'],
    'cs' => ['Czech', '🇨🇿'],
    'ro' => ['Romanian', '🇷🇴'],
    'hu' => ['Hungarian', '🇭🇺'],

];

        if (isset($map[$normalized])) {
            return $map[$normalized];
        }

        return [ucfirst($folder), '🌐'];
    }

    function admin_form(&$qa_content) {
        return null;
    }
}
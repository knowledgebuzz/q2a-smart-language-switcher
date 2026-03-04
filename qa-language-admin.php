<?php

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

class qa_language_admin {

    function allow_template($template) {
        return ($template == 'admin');
    }

    function admin_form(&$qa_content) {

        $saved = false;

        if (qa_clicked('qls_save')) {
            qa_opt('qls_auto_detect', (bool)qa_post_text('qls_auto_detect'));
            $saved = true;
        }

        return [
            'ok' => $saved ? 'Settings saved.' : null,

            'fields' => [
                [
                    'type' => 'checkbox',
                    'label' => 'Enable browser auto-detect language (first visit only)',
                    'value' => qa_opt('qls_auto_detect'),
                    'tags' => 'name="qls_auto_detect"',
                ],
            ],

            'buttons' => [
                [
                    'label' => 'Save Settings',
                    'tags' => 'name="qls_save"',
                ],
            ],
        ];
    }
}
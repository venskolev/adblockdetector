<?php
namespace vkolev\adblockdetector\acp;

class main_module
{
    public function main($id, $mode)
    {
        global $config, $template, $request, $user, $phpbb_log;

        // Обработване на формуляра за запис на JavaScript кода
        if ($request->is_set_post('submit'))
        {
            $new_code = $request->variable('adblock_js_code', '', true);
            $config->set('adblock_js_code', $new_code);
            $phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_CONFIG_ADBLOCK_JS_CODE', false);
        }

        $template->assign_vars([
            'ADBLOCK_JS_CODE' => $config['adblock_js_code'],
        ]);

        $this->tpl_name = 'adblockdetector_acp_main';
        $this->page_title = 'AdBlock Detector Configuration';
    }
}

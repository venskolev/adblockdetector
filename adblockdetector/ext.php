<?php
/**
*
* AdBlock Detector extension for the phpBB Forum Software package.
*
* @copyright 2024 Ventsislav Kolev
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vkolev\adblockdetector;

/**
* Extension class for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
    /**
     * Enable extension if phpBB version requirement is met
     *
     * @return bool
     * @access public
     */
    public function is_enableable()
    {
        $config = $this->container->get('config');
        // Проверка дали версията на phpBB е 3.3 или по-нова
        return phpbb_version_compare($config['version'], '3.3', '>=');
    }

    /**
     * Actions to perform when enabling the extension
     *
     * @param mixed $old_state
     * @return mixed
     */
    public function enable_step($old_state)
    {
        switch ($old_state) {
            case '':
                global $config;
                // Добавяне на празна конфигурация за JavaScript кода при активиране
                $config->set('adblock_js_code', '');
                return 'adblock_js_code_set';
            default:
                return parent::enable_step($old_state);
        }
    }

    /**
     * Actions to perform when disabling the extension
     *
     * @param mixed $old_state
     * @return mixed
     */
    public function disable_step($old_state)
    {
        switch ($old_state) {
            case '':
                global $config;
                // Изтриване на конфигурацията при деактивиране
                $config->delete('adblock_js_code');
                return 'adblock_js_code_deleted';
            default:
                return parent::disable_step($old_state);
        }
    }
}

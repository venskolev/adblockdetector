<?php
namespace vkolev\adblockdetector\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
    protected $config;
    protected $template;

    public function __construct(\phpbb\config\config $config, \phpbb\template\template $template)
    {
        $this->config = $config;
        $this->template = $template;
    }

    static public function getSubscribedEvents()
    {
        return [
            'core.page_footer' => 'add_adblock_script',
        ];
    }

    public function add_adblock_script($event)
    {
        // Зареждаме JavaScript кода от конфигурацията и го предаваме на шаблона
        $this->template->assign_var('ADBLOCK_JS_CODE', $this->config['adblock_js_code']);
    }
}


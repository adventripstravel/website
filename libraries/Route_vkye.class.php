<?php

defined('_EXEC') or die;

class Route_vkye
{
    private $database;
    private $lang;

    public function __construct()
    {
        $this->database = new Medoo();
        $this->lang = Session::get_value('vkye_lang');
    }

    public function on_change_start()
    {
        $settings = Functions::get_array_json_decoded($this->database->select('settings', '*'));

        if (!empty($settings))
            Session::set_value('settings', $settings[0]);

        if ($this->lang = 'es')
            Session::set_value('currency', 'MXN');
        else if ($this->lang = 'en')
            Session::set_value('currency', 'USD');
    }

    public function on_change_end()
    {

    }
}

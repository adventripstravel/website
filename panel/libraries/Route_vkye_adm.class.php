<?php

defined('_EXEC') or die;

class Route_vkye_adm
{
    private $path;
    private $database;

    public function __construct($path)
    {
        $this->path = $path;
        $this->database = new Medoo();
    }

    public function on_change_start()
    {
        Session::unset_value('settings');
        Session::unset_value('currency');

        $settings = Functions::get_array_json_decoded($this->database->select('settings', [
            'logotypes',
            'icontypes'
        ]));

        if (!empty($settings))
            Session::set_value('settings', $settings[0]);

        $paths = [
            '/Index/index'
        ];

        if (!in_array($this->path, $paths) AND User_level_vkye_adm::access($this->path) == false)
            header('Location: ' . User_level_vkye_adm::redirection());
    }

    public function on_change_end()
    {
        
    }
}

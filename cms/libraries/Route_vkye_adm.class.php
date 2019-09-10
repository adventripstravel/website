<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.libraries
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class Route_vkye_adm
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function on_change_start()
    {
        $free_paths = [
            '/Index/index',
            '/Index/logout',
        ];

        if (!in_array($this->path, $free_paths) AND User_level_vkye_adm::access($this->path) == false)
            header('Location: ' . User_level_vkye_adm::redirection());
    }

    public function on_change_end()
    {

    }
}

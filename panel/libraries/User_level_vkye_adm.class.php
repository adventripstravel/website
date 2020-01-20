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
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class User_level_vkye_adm
{
    static public function redirection()
    {
        $level = Session::get_value('_vkye_level');

        switch ($level)
        {
            case '{owner}':
                return 'index.php?c=bookings&m=index&p=today';
            break;

            default:
                return 'index.php?c=index&m=logout';
            break;
        }
    }

    static public function access($path)
    {
        $level = Session::get_value('_vkye_level');

        switch ($level)
        {
            case '{owner}':
                return true;
            break;

            default:
                return false;
            break;
        }
    }

    private function check_access_path($path, $access)
    {
        if (in_array($path, $access))
            return true;
        else
            return false;
    }
}

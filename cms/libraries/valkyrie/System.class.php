<?php

defined('_EXEC') or die;

/**
 *
 * @package Valkyrie.Libraries.Administrator
 *
 * @since 1.0.0
 * @version 1.0.0
 * @license You can see LICENSE.txt
 *
 * @author David Miguel Gómez Macías < davidgomezmacias@gmail.com >
 * @copyright Copyright (C) CodeMonkey - Platform. All Rights Reserved.
 */

class System
{
    private $security;

    public function __construct()
    {
        $this->security = new Security();
    }

    public function exists_session()
    {
        if ( Session::exists_var('_vkye_token') && Session::exists_var('_vkye_id_user') && Session::exists_var('_vkye_last_access') )
        {
            $last_access  = Session::get_value('_vkye_last_access');
            $now          = Format::get_date_hour();
            $time_elapsed = ( strtotime( $now ) - strtotime( $last_access ) );

            if ( $time_elapsed >= Configuration::$cookie_lifetime )
                return false;
            else
            {
                Session::set_value('_vkye_last_access', $now);
                return true;
            }
        }
        else
            return false;
    }

    public function go_to_location( $controller = false, $method = false, $params = false )
    {
        $url = $this->security->protocol() . "{$_SERVER['HTTP_HOST']}:{$_SERVER['SERVER_PORT']}{$_SERVER['REQUEST_URI']}";
        $url_part = explode(ADMINISTRATOR, $url);

        $url = $url_part[0] . ADMINISTRATOR . '/';

        $controller = ( $controller != false )? '?c=' . $controller : '';
        $method     = ( $method != false )? '&m=' . $method : '';
        $params     = ( $params != false )? '&p=' . $params : '';

        header("Location: {$url}index.php{$controller}{$method}{$params}");
    }
}

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
    /**
     *
     * @var object
     */
    private $security;

    /**
	 * Constructor.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->security = new Security();
        $this->database = new Medoo();
    }

    /**
	 * Verifica el status de la sesion.
     *
     * @return  boolean
     */
    public function exists_session()
    {
        if ( isset($_COOKIE['_vkye_token']) && !empty($_COOKIE['_vkye_token']) )
        {
            if (
                Session::exists_var('_vkye_token') &&
                Session::exists_var('_vkye_id_user') &&
                Session::exists_var('_vkye_user') &&
                Session::exists_var('_vkye_last_access') &&
                Session::exists_var('_vkye_level')
            )
            {
                return true;
            }
            else
            {
                $token = explode(':', $_COOKIE['_vkye_token']);

                $response = $this->database->select("sessions", [
                    "[>]users" => [
                        "id_user" => "id"
                    ],
                    "[>]levels" => [
                        "users.id_level" => "id"
                    ]
                ], [
                    "sessions.logout_date",
                    "users.id",
                    "users.username",
                    "levels.code"
                ], [
                    "AND" => [
                        'id_user' => $token[0],
                        'token' => $token[2],
                        "sessions.id_user[=]users.id",
                        "users.id_level[=]levels.id"
                    ]
                ]);

                if ( !isset($response[0]) || is_null($response[0]) )
                {
                    setcookie("_vkye_token", null, -1, '/');
                    return false;
                }

                else if ( !is_null($response[0]['logout_date']) )
                {
                    setcookie("_vkye_token", null, -1, '/');
                    return false;
                }

                else
                {
                    setcookie('_vkye_token', $response[0]['id'] .':'. $this->security->random_string(4) .':'. $token[2], time() + (Configuration::$cookie_lifetime * 30), "/");

                    Session::create_session_login([
                        'token' => $token,
                        'id_user' => $response[0]['id'],
                        'user' => $response[0]['username'],
                        'last_access' => Format::get_date_hour(),
                        'level' => $response[0]['code']
                    ]);

                    return true;
                }
            }
        }

        else // No hay session
        {
            return false;
        }
    }

    /**
	 * Crea y redirecciona a una url interna.
     *
     * @return  void
     */
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

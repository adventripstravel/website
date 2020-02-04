<?php

defined('_EXEC') or die;

class User_level_vkye_adm
{
    static public function access($path)
    {
        $paths = [];

        foreach (Session::get_value('user')['user_permissions'] as $value)
        {
            switch ($value)
            {
                case '{bookings_view}':
                    array_push($paths, '/Bookings/index');
                    break;

                case '{bookings_create}':
                    array_push($paths, '/Bookings/index');
                    break;

                case '{bookings_update}':
                    array_push($paths, '/Bookings/index');
                    break;

                case '{bookings_cancel}':
                    array_push($paths, '/Bookings/index');
                    break;

                default:
                    break;
            }
        }

        $paths = array_unique($paths);
        $paths = array_values($paths);

        return in_array($path, $paths) ? true : false;
    }

    static public function redirection()
    {
        if (Functions::check_access(['{bookings_view}','{bookings_create}','{bookings_update}','{bookings_cancel}']) == true)
            return 'index.php?c=bookings&m=index';
        else
            return 'index.php?c=index&m=logout';
    }
}

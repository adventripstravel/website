<?php
/**
 *
 * @package Valkyrie.Platform.Libraries
 *
 * @since 2.0.0
 * @version 1.0.0
 * @license You can see LICENSE.txt
 *
 * @author David Miguel Gómez Macías < davidgomezmacias@gmail.com >
 * @copyright Copyright (C) CodeMonkey - Valkyrie Platform. All Rights Reserved.
 */

defined('_EXEC') or die;

class Urls_registered_vkye
{
    static public $home_page_default = '/';

    static public function urls()
    {
        return [
            '/' => [
                'controller' => 'Index',
                'method' => 'index'
            ],
            '/experiencia/%param%' => [
                'controller' => 'Experiences',
                'method' => 'view'
            ],
        ];
    }
}

<?php

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
            '/booking/%param%' => [
                'controller' => 'Booking',
                'method' => 'index'
            ],
            '/voucher/%param%' => [
                'controller' => 'Voucher',
                'method' => 'index'
            ],
            '/contact' => [
                'controller' => 'Contact',
                'method' => 'index'
            ],
            '/terms' => [
                'controller' => 'Terms',
                'method' => 'index'
            ]
        ];
    }
}

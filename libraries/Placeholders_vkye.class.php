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

class Placeholders_vkye
{
    private $buffer;
    private $format;

    public function __construct($buffer)
    {
        $this->buffer = $buffer;
        $this->format = new Format();
    }

    public function run()
    {
        $this->buffer = $this->main_header();
        $this->buffer = $this->placeholders();

        return $this->buffer;
    }

    private function main_header()
    {
        return $this->format->include_file($this->buffer, 'header');
    }

    private function placeholders()
    {
        if (Session::get_value('lang') == 'es')
            $_vkye_email = 'reservaciones@exploore.mx';
        else if (Session::get_value('lang') == 'en')
            $_vkye_email = 'reservations@exploore.mx';

        $replace = [
            '{$_vkye_email}' => $_vkye_email,
            '{$_vkye_phone}' => '+52 (998) 420 90 29',
            '{$_vkye_facebook}' => 'https://www.facebook.com/exploore.mx/',
            '{$_vkye_instagram}' => 'https://www.instagram.com/',
            '{$_vkye_twitter}' => 'https://www.twitter.com/',
            '{$_vkye_youtube}' => 'https://www.youtube.com/',
        ];

        return $this->format->replace($replace, $this->buffer);
    }
}

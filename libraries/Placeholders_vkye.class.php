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
        $replace = [
            
        ];

        return $this->format->replace($replace, $this->buffer);
    }
}

<?php

defined('_EXEC') or die;

class Placeholders_vkye_adm
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
        $this->buffer = $this->replace_header();
        $this->buffer = $this->replace_placeholders();

        return $this->buffer;
    }

    private function replace_header()
    {
        return $this->format->include_file($this->buffer, 'header');
    }

    private function replace_placeholders()
    {
        $replace = [
            '{$_vkye_logotype_color}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['color'],
            '{$_vkye_logotype_black}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['black'],
            '{$_vkye_logotype_white}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['white'],
            '{$_vkye_icontype_color}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['color'],
            '{$_vkye_icontype_black}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['black'],
            '{$_vkye_icontype_white}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['white']
        ];

        return $this->format->replace($replace, $this->buffer);
    }
}

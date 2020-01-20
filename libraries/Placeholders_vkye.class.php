<?php

defined('_EXEC') or die;

class Placeholders_vkye
{
    private $buffer;
    private $format;
    private $lang;

    public function __construct($buffer)
    {
        $this->buffer = $buffer;
        $this->format = new Format();
        $this->lang = Session::get_value('vkye_lang');
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
            '{$_vkye_lang_es}' => '?' . Language::get_lang_url('es'),
            '{$_vkye_lang_en}' => '?' . Language::get_lang_url('en'),
            '{$_vkye_logotype_color}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['color'],
            '{$_vkye_logotype_black}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['black'],
            '{$_vkye_logotype_white}' => '{$path.uploads}' . Session::get_value('settings')['logotypes']['white'],
            '{$_vkye_icontype_color}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['color'],
            '{$_vkye_icontype_black}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['black'],
            '{$_vkye_icontype_white}' => '{$path.uploads}' . Session::get_value('settings')['icontypes']['white'],
            '{$_vkye_email}' => Session::get_value('settings')['contact']['email'][$this->lang],
            '{$_vkye_phone}' => Session::get_value('settings')['contact']['phone'][$this->lang],
            '{$_vkye_tripadvisor}' => Session::get_value('settings')['social_media']['tripadvisor'],
            '{$_vkye_facebook}' => Session::get_value('settings')['social_media']['facebook'],
            '{$_vkye_instagram}' => Session::get_value('settings')['social_media']['instagram'],
            '{$_vkye_twitter}' => Session::get_value('settings')['social_media']['twitter'],
            '{$_vkye_youtube}' => Session::get_value('settings')['social_media']['youtube']
        ];

        return $this->format->replace($replace, $this->buffer);
    }
}

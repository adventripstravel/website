<?php
defined('_EXEC') or die;

class Functions
{
    private $database;
    private $security;

    public function __construct()
    {
        $this->database = new Medoo();
        $this->security = new Security();
    }

    static function check_session()
    {
        return ( isset($_COOKIE['_vkye_token']) && !empty($_COOKIE['_vkye_token']) ) ? ( Session::exists_var('_vkye_token') && Session::exists_var('_vkye_id_user') && Session::exists_var('_vkye_user') && Session::exists_var('_vkye_last_access') && Session::exists_var('_vkye_level') ) ? true : false : false;
    }

    static function payment_methods()
    {
        return [
            [ 'code' => 'cash', 'title' => 'efectivo' ],
            [ 'code' => 'deposit', 'title' => 'deposito' ],
            [ 'code' => 'transfer', 'title' => 'transferencia' ],
            [ 'code' => 'terminal', 'title' => 'terminal' ],
            [ 'code' => 'coupon', 'title' => 'cupón' ],
            [ 'code' => 'other', 'title' => 'otro' ],
        ];
    }
}

<?php

defined('_EXEC') or die;

/**
* @package valkyrie.libraries
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

class Functions
{
    public static function get_decoded_query($query)
    {
        foreach ($query as $key => $value)
        {
            if (is_array($query[$key]))
            {
                foreach ($query[$key] as $subkey => $subvalue)
                    $query[$key][$subkey] = (is_array(json_decode($query[$key][$subkey], true)) AND (json_last_error() == JSON_ERROR_NONE)) ? json_decode($query[$key][$subkey], true) : $query[$key][$subkey];
            }
            else
                $query[$key] = (is_array(json_decode($query[$key], true)) AND (json_last_error() == JSON_ERROR_NONE)) ? json_decode($query[$key], true) : $query[$key];
        }

        return $query;
    }

    public static function get_date($action = null, $date = null, $op1 = null, $op2 = null)
	{
        date_default_timezone_set(Configuration::$time_zone);

        if ($action == 'format')
        {
            setlocale(LC_TIME, 'spanish');

            return utf8_encode(strftime("%d %B, %Y", strtotime($date)));
        }
        else if ($action == 'sum')
            return date('Y-m-d', strtotime($date . ' + ' . $op1 . ' ' . $op2));
        else if ($action == 'res')
            return date('Y-m-d', strtotime($date . ' - ' . $op1 . ' ' . $op2));
        else
            return date('Y-m-d');
	}

    public static function get_hour()
	{
        date_default_timezone_set(Configuration::$time_zone);

		return date('h:i:s', time());
	}

    public static function get_date_hour()
	{
        date_default_timezone_set(Configuration::$time_zone);

		return date('Y-m-d h:i:s', time());
	}

    public static function get_random($length)
    {
        $security = new Security;

        return !empty($length) ? strtoupper($security->random_string($length)) : null;
    }

    public static function get_encrypted_password($key)
    {
        $security = new Security;

        return !empty($key) ? $security->create_password($key) : null;
    }

    public static function get_shortened_text($text, $length)
	{
		return (strlen(strip_tags($text)) > $length) ? substr(strip_tags($text), 0, $length) . '...' : substr(strip_tags($text), 0, $length);
    }

    public static function get_formatted_currency($number = 0, $currency = 'MXN')
    {
        if (!empty($number))
            return '$ ' . number_format($number, 2, '.', ',') . ' ' . $currency;
        else
            return '$ 0.00 ' . $currency;
    }

    static public function get_currency_exchange($number = 1, $from = 'MXN', $to = 'USD')
    {
        $exchange = 0;

        $client =  new SoapClient(null, array(
            'location' => 'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL',
            'uri'      => 'http://DgieWSWeb/DgieWS?WSDL',
            'encoding' => 'ISO-8859-1',
            'trace'    => false
        ));

        try
        {
            $result = $client->tiposDeCambioBanxico();
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }

        if (!empty($result))
        {
            $domd = new DOMDocument();
            $domd->loadXML($result);

            $domxp = new DOMXPath($domd);
            $domxp->registerNamespace('bm', 'http://ws.dgie.banxico.org.mx');

            $eval = $domxp->evaluate("//*[@IDSERIE='SF60653']/*/@OBS_VALUE");
            $exchange = $eval->item(0)->value;

            if ($from == 'MXN' AND $to == 'USD')
                $exchange = $number / $exchange;
            else if ($from == 'USD' AND $to == 'MXN')
                $exchange = $number * $exchange;
        }

        return $exchange;
    }

    public static function check_access($user_level)
    {
		if (in_array(Session::get_value('_vkye_user_level'), $user_level))
            return true;
        else
            return false;
    }

    public static function check_email($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function uploader($file = null, $upload_directory = PATH_UPLOADS, $valid_extensions = ['png','jpg','jpeg'], $maximum_file_size = 'unlimited', $multiple = false)
	{
        if (!empty($file))
        {
            $components = new Components;

            $components->load_component('uploader');

            $uploader = new Uploader;

            if ($multiple == true)
            {
                foreach ($file as $key => $value)
                {
                    $uploader->set_file_name($value['name']);
                    $uploader->set_file_temporal_name($value['tmp_name']);
                    $uploader->set_file_type($value['type']);
                    $uploader->set_file_size($value['size']);
                    $uploader->set_upload_directory($upload_directory);
                    $uploader->set_valid_extensions($valid_extensions);
                    $uploader->set_maximum_file_size($maximum_file_size);

                    $value = $uploader->upload_file();

                    if ($value['status'] == 'success')
                        $file[$key] = $value['file'];
                    else
                        unset($file[$key]);
                }

                $file = array_merge($file);
            }
            else if ($multiple == false)
            {
                $uploader->set_file_name($file['name']);
                $uploader->set_file_temporal_name($file['tmp_name']);
                $uploader->set_file_type($file['type']);
                $uploader->set_file_size($file['size']);
                $uploader->set_upload_directory($upload_directory);
                $uploader->set_valid_extensions($valid_extensions);
                $uploader->set_maximum_file_size($maximum_file_size);

                $file = $uploader->upload_file();

                if ($file['status'] == 'success')
                    $file = $file['file'];
                else
                    $file = null;
            }

            return $file;
        }
        else
            return null;
	}

    public static function undoloader($file = null, $upload_directory = PATH_UPLOADS)
    {
        if (!empty($file))
        {
            if (is_array($file))
            {
                foreach ($file as $value)
                    unlink($upload_directory . $value);
            }
            else
                unlink($upload_directory . $file);
        }
    }
}

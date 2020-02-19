<?php

defined('_EXEC') or die;

/**
* @package valkyrie.libraries
*
* @summary Stock de funciones opcionales para el programador.
*
* @author Gersón Aarón Gómez Macías <ggomez@codemonkey.com.mx>
* <@create> 01 de enero, 2019.
*
* @version 1.0.0.
*
* @copyright Code Monkey <contacto@codemonkey.com.mx>
*/

class Functions
{
    /**
    * @summary Entrega la fecha actual.
    *
    * @param string $format: Formato en el que retornará la fecha.
    *
    * @return date
    */
    static public function get_current_date($format = 'Y-m-d')
    {
		return date($format);
    }

    /**
    * @summary Entrega la resta de un tiempo a una fecha.
    *
    * @param date $date: Fecha a restar.
    * @param int $number: Numero de $lapse que se va a restar a $date.
    * @param string $lapse: (year, month, week, days) Lapso de tiempo que se va a restar a $date.
    * @param string $format: Formato en el que retornará la fecha.
    *
    * @return date
    */
    static public function get_past_date($date, $number, $lapse, $format = 'Y-m-d')
    {
        return date($format, strtotime(date('d-m-Y', strtotime($date)) . ' - ' . $number . ' ' . $lapse));
    }

    /**
    * @summary Entrega la suma de un tiempo a una fecha.
    *
    * @param date $date: Fecha a sumar.
    * @param int $number: Numero de $lapse que se va a sumar a $date.
    * @param string $lapse: (year, month, week, days) Lapso de tiempo que se va a sumar a $date.
    * @param string $format: Formato en el que retornará la fecha.
    *
    * @return date
    */
    static public function get_future_date($date, $number, $lapse, $format = 'Y-m-d')
    {
        return date($format, strtotime(date('d-m-Y', strtotime($date)) . ' + ' . $number . ' ' . $lapse));
    }

    /**
    * @summary Entrega una fecha con formato.
    *
    * @param date $date: Fecha a dar formato.
    * @param string $format: Formato en el que retornará la fecha.
    *
    * @return date
    */
    static public function get_format_date($date, $format = 'Y-m-d')
    {
        return date($format, strtotime($date));
    }

    /**
    * @summary Entrega la hora actual.
    *
    * @param string $format: Formato en el que retornará la hora.
    *
    * @return date
    */
    static public function get_current_hour($format = 'H:i:s')
    {
		return date($format, time());
    }

    /**
    * @summary Entrega la resta de un tiempo a una hora.
    *
    * @param time $hour: Hora a restar.
    * @param int $number: Numero de $lapse que se va a restar a $hour.
    * @param string $lapse: (hour, minute, second) Lapso de tiempo que se va a restar a $hour.
    * @param string $format: Formato en el que retornará la hora.
    *
    * @return date
    */
    static public function get_past_hour($hour, $number, $lapse, $format = 'H:i:s')
    {
        return date($format, strtotime('-' . $number . ' ' . $lapse, strtotime(date('H:i:s', strtotime($hour)))));
    }

    /**
    * @summary Entrega la suma de un tiempo a una hora.
    *
    * @param time $hour: Hora a sumar.
    * @param int $number: Numero de $lapse que se va a sumar a $hour.
    * @param string $lapse: (hour, minute, second) Lapso de tiempo que se va a sumar a $hour.
    * @param string $format: Formato en el que retornará la hora.
    *
    * @return date
    */
    static public function get_future_hour($hour, $number, $lapse, $format = 'H:i:s')
    {
        return date($format, strtotime('+' . $number . ' ' . $lapse, strtotime(date('H:i:s', strtotime($hour)))));
    }

    /**
    * @summary Entrega una hora con formato.
    *
    * @param time $hour: Hora a dar formato.
    * @param string $format: Formato en el que retornará la hora.
    *
    * @return date
    * @return string
    */
    static public function get_format_hour($hour, $format = 'H:i:s')
    {
        if ($format == 'hrs')
            return $hour . ' Hrs';
        else
            return date($format, strtotime($hour));
    }

    /**
    * @summary Entrega la fecha y hora actual.
    *
    * @param string $format: Formato en el que retornará la fecha y hora.
    *
    * @return date
    */
    static public function get_current_datehour($format = 'Y-m-d H:i:s')
    {
		return date($format, time());
    }

    /**
    * @summary Entrega la diferencia entre dos fechas, horas o fechas y horas.
    *
    * @param date-time-datetime $datehour1: Fecha inicial.
    * @param date-time-datetime $datehour2: Fecha final.
    * @param string $lapse: (year, month, days, hours, minutes, seconds, all) Lapso de tiempo en el que retornara la función.
    * @param boolean $format: Logflag si retornará la función con su formato string.
    *
    * @return string
    * @return array
    */
    static public function get_diff_datehour($datehour1, $datehour2, $lapse = 'all', $format = true)
    {
        $datehour1 = new DateTime($datehour1);
        $datehour2 = new DateTime($datehour2);

        $a1 = $datehour1->diff($datehour2);
        $a2 = $a1->days;
        $a3 = '';

        $y = $a1->y;
        $m = $a1->m;
        $d = $a1->d;
        $h = $a1->h;
        $i = $a1->i;
        $s = $a1->s;

        if ($lapse == 'year')
        {
            $y = round($a2 / 365);
            $a3 .= $y . (($format == true) ? (($y == 1) ? ' año' : ' años') : '');
        }
        else if ($lapse == 'month')
        {
            $m = round($a2 / 30);
            $a3 .= $m . (($format == true) ? (($m == 1) ? ' mes' : ' meses') : '');
        }
        else if ($lapse == 'days')
        {
            $d = round($a2);
            $a3 .= $d . (($format == true) ? (($d == 1) ? ' día' : ' días') : '');
        }
        else if ($lapse == 'hours')
        {
            $h = round($a2 * 24);
            $a3 .= $h . (($format == true) ? (($h == 1) ? ' hora' : ' horas') : '');
        }
        else if ($lapse == 'minutes')
        {
            $i = round($a2 * 1440);
            $a3 .= $i . (($format == true) ? (($i == 1) ? ' minuto' : ' minutos') : '');
        }
        else if ($lapse == 'seconds')
        {
            $s = round($a2 * 86400);
            $a3 .= $s . (($format == true) ? (($s == 1) ? ' segundo' : ' segundos') : '');
        }
        else if ($lapse == 'all')
        {
            if ($format == true)
            {
                if ($y > 0)
                    $a3 .= $y . (($y == 1) ? ' año ' : ' años ');

                if ($m > 0)
                    $a3 .= $m . (($m == 1) ? ' mes ' : ' meses ');

                if ($d > 0)
                    $a3 .= $d . (($d == 1) ? ' día ' : ' días ');

                if ($h > 0)
                    $a3 .= $h . (($h == 1) ? ' hora ' : ' horas ');

                if ($i > 0)
                    $a3 .= $i . (($i == 1) ? ' minuto ' : ' minutos ');

                if ($s > 0)
                    $a3 .= $s . (($s == 1) ? ' segundo ' : ' segundos ');
            }
            else
            {
                $a3 = [];
                $a3['y'] = $y;
                $a3['m'] = $m;
                $a3['d'] = $d;
                $a3['h'] = $h;
                $a3['i'] = $i;
                $a3['s'] = $s;
            }
        }

        return $a3;
    }

    /**
    * @summary Entrega el tipo de cambio actual entre USD/MXN, MXN/USD.
    *
    * @param int-float $number: Cantidad a convertir.
    * @param string $from: (USD, MXN) Moneda de la que se convertirá.
    * @param string $to: (USD, MXN) Moneda a la que se convertirá.
    *
    * @return int
    * @return float
    */
    static public function get_currency_exchange($number = 0, $from = 'USD', $to = 'MXN')
    {
        $a1 = curl_init();

        curl_setopt($a1, CURLOPT_URL, 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF63528/datos/oportuno?token=ac32cf33a053bab54c26b061f4ebda76c4b21fa2d772a354779d121641c580f9');
        curl_setopt($a1, CURLOPT_RETURNTRANSFER, true);

        $a2 = Functions::get_array_json_decoded(curl_exec($a1));
        $a2 = $a2['bmx']['series'][0]['datos'][0]['dato'];

        curl_close($a1);

        if ($from == 'USD' AND $to == 'MXN')
            return ($number * $a2);
        else if ($from == 'USD' AND $to == 'USD')
            return $number;
        else if ($from == 'MXN' AND $to == 'USD')
            return ($number / $a2);
        else if ($from == 'MXN' AND $to == 'MXN')
            return $number;
    }

    /**
    * @summary Entrega una moneda con formato.
    *
    * @param int-float $number: Cantidad a dar formato.
    * @param string $currency: Moneda en la que retornará $number.
    *
    * @return string
    */
    public static function get_format_currency($number = 0, $currency = 'MXN', $decimals = 2)
    {
        return '$ ' . number_format($number, $decimals, '.', ',') . ' ' . $currency;
    }

    /**
    * @summary: Valida que un correo electrónico este escrito correctamente.
    *
    * @param string $email: Correo electrónico a validar.
    *
    * @return boolean
    */
    public static function check_email($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    /**
    * @summary: Valida el permiso de acceso a un módulo o funcionalidad cuando existe una sesión activa.
    *
    * @param array $permissions: Permisos a revisar.
    *
    * @return boolean
    */
    static public function check_access($permissions)
    {
        $access = false;

        if (Session::exists_var('session') == true)
        {
            foreach ($permissions as $value)
            {
                if (in_array($value, Session::get_value('user')['user_permissions']))
                    $access = true;
            }
        }

        return $access;
    }

    /**
    * @summary: Entrega una cadena de texto aleatoria.
    *
    * @param string $length: (<numbers>) Número de caracteres en el retornará la cadena.
    * @param string $letter: (uppercase, lowercase, allcase) Formato en el que retornará la cadena.
    *
    * @return string
    */
    public static function get_random_string($length = 8, $lettercase = 'allcase')
    {
        $security = new Security;

        if ($lettercase == 'uppercase')
            return strtoupper($security->random_string($length));
        else if ($lettercase == 'lowercase')
            return strtolower($security->random_string($length));
        else if ($lettercase == 'allcase')
            return $security->random_string($length);
    }

    /**
    * @summary: Entrega una cadena de texto encriptada bajo el estandar Vkye Password.
    *
    * @param string $string: Cadena a encriptar.
    *
    * @return string
    */
    public static function get_encrypted_string($string)
    {
        $security = new Security;

        return $security->create_password($string);
    }

    /**
    * @summary: Entrega una cadena de texto recortada.
    *
    * @param string $string: Cadena a recortar.
    * @param string $length: (<numbers>) Número de caracteres en el retornará la cadena.
    *
    * @return string
    */
    public static function get_shortened_string($string, $length = '400')
	{
		return (strlen(strip_tags($string)) > $length) ? substr(strip_tags($string), 0, $length) . '...' : substr(strip_tags($string), 0, $length);
    }

    /**
    * @summary: Entrega una cadena de limpia para colocar en una URL.
    *
    * @param string $string: Cadena a limpiar.
    *
    * @return string
    */
    public static function get_cleaned_string_to_url($string)
	{
		return strtolower(str_replace(' ', '', $string));
    }

    /**
    * @summary: Entrega un array unidimensional/multimensional json decodificado hasta 2 niveles.
    *
    * @param string-array $json: Array a decodificar.
    *
    * @return array
    */
    public static function get_array_json_decoded($json)
    {
        if (is_array($json))
        {
            foreach ($json as $key => $value)
            {
                if (is_array($json[$key]))
                {
                    foreach ($json[$key] as $subkey => $subvalue)
                        $json[$key][$subkey] = (is_array(json_decode($json[$key][$subkey], true)) AND (json_last_error() == JSON_ERROR_NONE)) ? json_decode($json[$key][$subkey], true) : $json[$key][$subkey];
                }
                else
                    $json[$key] = (is_array(json_decode($json[$key], true)) AND (json_last_error() == JSON_ERROR_NONE)) ? json_decode($json[$key], true) : $json[$key];
            }

            return $json;
        }
        else
            return (is_array(json_decode($json, true)) AND (json_last_error() == JSON_ERROR_NONE)) ? json_decode($json, true) : $json;
    }

    /**
    * @summary: Sube archivos al servidor.
    *
    * @param file $file: Archivo a subir.
    * @param string $upload_directory: Directorio donde se va subir $file.
    * @param array $valid_extensions: Extensiones válidas para subir $file.
    * @param string $maximum_file_size: Tamaño máximo permitido para subir $file.
    * @param boolean $multiple: Identificador para subir multiples archivos.
    *
    * @return string
    */
    public static function uploader($file, $upload_directory = PATH_UPLOADS, $valid_extensions = ['png','jpg','jpeg'], $maximum_file_size = 'unlimited', $multiple = false)
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

    /**
    * @summary: Elimina archivos del servidor.
    *
    * @param string $file: Archivo a eliminar.
    * @param string $upload_directory: Directorio de donde se va eliminar $file.
    */
    public static function undoloader($file, $upload_directory = PATH_UPLOADS)
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

    static public function get_browser()
    {
        $browser = "OTHER";

        foreach ( ["IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME"] as $parent )
        {
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/','',$version);

            if ( $s )
                $browser = $parent;
        }

        return $browser;
    }

    static public function get_ip()
    {
        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            return getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            return getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            return getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            return getenv('REMOTE_ADDR');
        else
            return 'UNKNOWN';
    }

    static function get_os()
    {
        $os = 'OTHER';

        foreach ( ["WIN","MAC","LINUX"] as $val )
        {
            if ( strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val) !== false )
                $os = $val;
        }

        return $os;
    }

    static public function get_device()
    {
        if ( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') )
            return "iPad";
        else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') )
            return "iPhone";
        else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') )
            return "BlackBerry";
        else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') )
            return "Android";
        else
            return "Otro";
    }

    static public function device()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if ( preg_match( '/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower( $_SERVER['HTTP_USER_AGENT'] ) ) )
            $tablet_browser++;

        if ( preg_match( '/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower( $_SERVER['HTTP_USER_AGENT'] ) ) )
            $mobile_browser++;

        if ( ( strpos( strtolower( $_SERVER['HTTP_ACCEPT'] ), 'application/vnd.wap.xhtml+xml' ) > 0 ) or ( ( isset( $_SERVER['HTTP_X_WAP_PROFILE'] ) or isset( $_SERVER['HTTP_PROFILE'] ) ) ) )
            $mobile_browser++;

        $mobile_ua = strtolower( substr( $_SERVER['HTTP_USER_AGENT'], 0, 4 ) );
        $mobile_agents = [
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
            'newt','noki','palm','pana','pant','phil','play','port','prox',
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
            'wapr','webc','winw','winw','xda ','xda-'
        ];

        if ( in_array( $mobile_ua, $mobile_agents ) )
            $mobile_browser++;

        if ( strpos( strtolower( $_SERVER['HTTP_USER_AGENT'] ), 'opera mini' ) > 0 )
        {
            $mobile_browser++;

            $stock_ua = strtolower( isset( $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] ) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : ( isset( $_SERVER['HTTP_DEVICE_STOCK_UA'] ) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : '' ) );

            if ( preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua) )
                $tablet_browser++;
		}

        if ( $tablet_browser > 0 )
            return 'tablet';
        else if ( $mobile_browser > 0 )
            return 'mobile';
        else
            return 'desktop';
    }

    static public function get_client_info()
    {
        $info['ip'] = Functions::get_ip();
		$info['browser'] = Functions::get_browser();
		$info['device'] = ucfirst(Functions::device());

		if ( $info['device'] == ucfirst('tablet') || $info['device'] == ucfirst('mobile') )
			$info['so'] = Functions::get_device();
		else
			$info['so'] = Functions::get_os();

		$info['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

        return $info;
    }
}

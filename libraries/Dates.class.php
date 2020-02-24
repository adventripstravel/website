<?php

class Dates
{
    public function __construct()
    {
        date_default_timezone_set( Configuration::$time_zone );
    }

    static public function formatted_date ( $date = null, $get = null )
    {
        if ( is_null($date) )
            $date = date('Y-m-d');

        $days = [
            'en' => [
                "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
            ],
            'es' => [
                "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"
            ]
        ];

        $months = [
            'en' => [
                "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
            ],
            'es' => [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ]
        ];

        $date = substr($date, 0, 10);

        $day_number = date('d', strtotime($date));
        $day = date('l', strtotime($date));
        $month = date('F', strtotime($date));
        $year = date('Y', strtotime($date));
        $day_name = str_replace($days['en'], $days['es'], $day);
        $month_name = str_replace($months['en'], $months['es'], $month);

        switch ( $get )
        {
            case 'formatted':
                return $day_name ." ". $day_number ." de ". $month_name ." del ". $year;
                break;

            default:
                return $day_number ."-".$month_name."-".$year;
                break;
        }
    }

    static public function get_day_week( $date = null )
    {
        date_default_timezone_set(Configuration::$time_zone);

        if ( !is_null($date) )
        {
            $days = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];

            return $days[date('N', strtotime($date)) - 1];
        }
        else
            return null;
    }

    static public function get_month( $date = null )
    {
        date_default_timezone_set(Configuration::$time_zone);

        if ( !is_null($date) )
        {
            $months = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];

            return $months[date('m', strtotime($date)) - 1];
        }
        else
            return null;
    }

    static public function get_current_month()
    {
        return [date('Y-m-d', strtotime('first day of this month')), date('Y-m-d', strtotime('last day of this month'))];
    }

    static public function get_last_month()
    {
        return [date('Y-m-d', strtotime('first day of last month')), date('Y-m-d', strtotime('last day of last month'))];
    }
}

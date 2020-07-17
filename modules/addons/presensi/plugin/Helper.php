<?php
/**
 * presensi-siswa
 * Helper.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 11/07/2020
 * Time  : 11:43
 */

namespace Modules\Presensi\Plugin;


use DateInterval;
use DatePeriod;
use DateTime;

class Helper
{
    public  static function workingDay($_start,$_end)
    {
        $datetime1 = new DateTime($_start);
        $datetime2 = new DateTime($_end);
        $datetime2 = $datetime2->modify( '+1 day' );
        $days = array();
        $period = new DatePeriod($datetime1, new DateInterval('P1D'), $datetime2);
        foreach($period as $dt)
        {
            $curr = $dt->format('D');

            if($curr != 'Sun')
            {
                $days[]= $dt->format('Y-m-d');
            }
        }
        return $days;
    }

    public static function lastDay($bln_thn)
    {
        list($bln,$thn)=explode("-",$bln_thn);
        $first = $thn."-".$bln."-01";
        $date = new DateTime($first);
        $date->modify('last day of this month');
        $last = $date->format('Y-m-d');
        return $last;
    }

    public static function firstday($bt)
    {
        list($bln,$thn) = explode("-", $bt);
        $first = $thn."-".$bln."-01";
        return $first;
    }

    public static function workBulanan($bulan)
    {
        $start = self::firstday($bulan);
        $end = self::lastDay($bulan);
        return self::workingDay($start, $end);
    }

    /**
     * @param array $array
     * @param string $key
     * @param string $get_value
     * @return array|mixed
     */
    public static function search_by_value(array $array, $key, $get_value)
    {
        $result = array();
        if($array){
            foreach ($array as $k => $v)
            {
                if($v[$key] == $get_value){
                    $result = $array[$k];
                }
            }
        }

        return $result;
    }
}
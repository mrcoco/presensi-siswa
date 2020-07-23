<?php
/**
 * htdocs
 * HelperExtension.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 23/07/2020
 * Time  : 10:26
 */

namespace Phalms;


class HelperExtension
{

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
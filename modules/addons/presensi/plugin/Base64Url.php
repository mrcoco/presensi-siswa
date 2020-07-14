<?php
/**
 * htdocs
 * Base64Url.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 14/07/2020
 * Time  : 10:48
 */

namespace Modules\Presensi\Plugin;


final class Base64Url
{
    /**
     * @param string $data        The data to encode
     * @param bool   $use_padding If true, the "=" padding at end of the encoded value are kept, else it is removed
     *
     * @return string The data encoded
     */
    public static function encode($data, $use_padding = false)
    {
        $encoded = strtr(base64_encode($data), '+/', '-_');

        return true === $use_padding ? $encoded : rtrim($encoded, '=');
    }

    /**
     * @param string $data The data to decode
     *
     * @return string The data decoded
     */
    public static function decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

}
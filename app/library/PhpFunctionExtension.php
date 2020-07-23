<?php
namespace Phalms;
/**
 * htdocs
 * PhpFunctionExtension.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 23/07/2020
 * Time  : 10:15
 */

class PhpFunctionExtension
{
    /**
     * This method is called on any attempt to compile a function call
     */
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '('. $arguments . ')';
        }
    }
}
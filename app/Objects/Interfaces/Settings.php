<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 28/08/2019
 * Time: 02:07 PM
 */

namespace App\Objects\Interfaces;


interface Settings
{
    public function get($key, $default = null);

    public function set($key, $value);
}
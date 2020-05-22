<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 28/08/2019
 * Time: 02:14 PM
 */

namespace App\Objects;
use App\Objects\Interfaces\Settings as SettingsInterface;
use App\Models\Settings as SettingsModel;

class Settings implements SettingsInterface
{

    public function get($key, $default = null)
    {
        return SettingsModel::get($key, $default);
    }

    public function set($key, $value)
    {
        return SettingsModel::set($key, $value);
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 22/08/19
 * Time: 11:40
 */

namespace App\Objects;

final class Select
{

    public static function create($array, $selected = null, $prepend = null) {
        $output = '';

        if(is_array($prepend)) {
            foreach($prepend as $key => $value) {
                $output .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }

        foreach($array as $key => $value) {
            $output .= '<option value="'.$key.'" ';
            if(is_array($selected)) {
                if(in_array($key, $selected)) {
                    $output .= 'selected';
                }
            }else {
                if($selected == $key) {
                    $output .= 'selected';
                }
            }
            $output .= '>'.$value.'</option>';
        }

        return $output;

    }

}
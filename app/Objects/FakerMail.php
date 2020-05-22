<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 08/08/19
 * Time: 15:25
 */

namespace App\Objects;


final class FakerMail
{

    public function embedData($data, $name, $type) {
        return 'data:'.$type.';base64,'.base64_encode($data);
    }

}
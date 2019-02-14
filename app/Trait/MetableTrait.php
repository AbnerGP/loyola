<?php
namespace App\Http\Traits;

use Plank\Metable\Metable;

trait MetableTrait
{
    use Metable;

    /**
     * Initialize the trait.
     *
     * @return void
     */
    public static function bootMetable()
    {

    }

    /**
     * Retrieve all meta attached to the model as a key/value map.
     *
     * @return Collection
     */
    public function getAllMeta()
    {
        return $this->getMetaCollection()->toBase()->map(function (\App\Models\Metable\Metable $meta) {
            return $meta->getAttribute('value');
        });
    }
}
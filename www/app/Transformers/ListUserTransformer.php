<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ListUser;

/**
 * Class ListUserTransformer.
 *
 * @package namespace App\Transformers;
 */
class ListUserTransformer extends TransformerAbstract
{
    /**
     * Transform the ListUser entity.
     *
     * @param \App\Entities\ListUser $model
     *
     * @return array
     */
    public function transform(ListUser $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

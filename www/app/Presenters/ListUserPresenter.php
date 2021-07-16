<?php

namespace App\Presenters;

use App\Transformers\ListUserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ListUserPresenter.
 *
 * @package namespace App\Presenters;
 */
class ListUserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ListUserTransformer();
    }
}

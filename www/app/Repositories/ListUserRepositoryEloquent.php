<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\list_userRepository;
use App\Entities\ListUser;
use App\Validators\ListUserValidator;

/**
 * Class ListUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ListUserRepositoryEloquent extends BaseRepository implements ListUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ListUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ListUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

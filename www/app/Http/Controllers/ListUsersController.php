<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ListUserCreateRequest;
use App\Http\Requests\ListUserUpdateRequest;
use App\Repositories\ListUserRepository;
use App\Validators\ListUserValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class ListUsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ListUsersController extends Controller
{
    /**
     * @var ListUserRepository
     */
    protected $repository;

    /**
     * @var ListUserValidator
     */
    protected $validator;

    /**
     * ListUsersController constructor.
     *
     * @param ListUserRepository $repository
     * @param ListUserValidator $validator
     */
    public function __construct(ListUserRepository $repository, ListUserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $listUsers = $this->repository->orderBy('id','desc')->all();

        return response()->json([
            'data' => $listUsers,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ListUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $listUser = $this->repository->create($request->all());

            $response = [
                'message' => 'ListUser created.',
                'data'    => $listUser->toArray(),
            ];

            return response()->json($response);



        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listUser = $this->repository->find($id);

        return response()->json([
            'data' => $listUser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ListUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request,$id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $listUser = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ListUser updated.',
                'data'    => $listUser->toArray(),
            ];

            return response()->json($response);



        } catch (ValidatorException $e) {


            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);



        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'ListUser deleted.',
            'deleted' => $deleted,
        ]);

    }

        /**
     * Search Lisf.
     *
     * @param  int $term
     *
     * @return \Illuminate\Http\Response
     */
    public function search($term)
    {
        if($term){
            $search = DB::table('list_users')
            ->where('name', 'like', '%'.$term.'%')
            ->get();
        }

        if(empty($search)){
           return [];
        }

        return response()->json([
            'data' => $search
        ]);

    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->userRepository->all();

            return $this->sendResponse(UserResource::collection($users));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $dados = $request->only([
                'name', 'email', 'password'
            ]);
    
            $dados['password'] = Hash::make($request->password);

            $novo_usuario = $this->userRepository->create($dados);
    

            return $this->sendResponse(new UserResource($novo_usuario), null, 201);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->find_by_id($id);

            return $this->sendResponse(new UserResource($user));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $dados = $request->all();

            $user_atualizado = $this->userRepository->update($dados, $id);

            return $this->sendResponse(new UserResource($user_atualizado));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);

            return $this->sendResponse(null, 'Registro excluído com sucesso', 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }
}

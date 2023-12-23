<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginNaoAutorizadoException;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user_repository;

    public function __construct(UserRepository $user_repository) {
        $this->user_repository = $user_repository;
    }


    public function login(Request $request): JsonResponse
    {
        try {
            $user = $this->user_repository->find_user_by_email($request->email);

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw new LoginNaoAutorizadoException();
            }
        
            $result['token'] = $user->createToken('token-name', [$user->type])->plainTextToken;
            $result['user']  = new UserResource($user);

            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Requisição feita com sucesso',
            ], 200);
        } catch (LoginNaoAutorizadoException $e) {
            return response()->json([
                'success' => false,
                'data' => $e->customErrorMessage(),
                'message' => $e->getMessage(),
            ], 400);
        }
        
    }
}

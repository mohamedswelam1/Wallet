<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    public function login(LoginRequest $request ,LoginService  $loginService)
    {
        try{
            if ($user = $loginService->checkLogin($request->validated())) {
                $token = $user->createToken('API Token')->plainTextToken;
                return ApiResponse::success(['token' => $token], 'Login successful');
            }
            return ApiResponse::error('The provided credentials are incorrect.', 401);

        }catch (\Exception $e){
            return ApiResponse::error('Server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

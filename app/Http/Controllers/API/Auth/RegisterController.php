<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request , RegisterService $registerService)
    {

        try {
            $user = $registerService->register($request->validated()) ;

            if ($user){
                return ApiResponse::success(['data' => $user], 'Register successful');
            }
            return ApiResponse::error('An error occurred during register', 401);
        }catch (\Exception $e){
            return ApiResponse::error('Server error', 500);
        }
    }
}

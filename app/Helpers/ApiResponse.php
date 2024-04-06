<?php
namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * Generate an error response.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = null, $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'error' => $message
        ], $statusCode);
    }

}

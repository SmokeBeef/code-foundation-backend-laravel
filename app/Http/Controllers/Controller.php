<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    public static function responseSuccess(string $message, mixed $data, int $code = 200, ?array $pagination = null)
    {
        return response()->json([
            "success" => true,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "pagination" => $pagination
        ], $code);
    }
    public static function responseError(string $message, int $code = 500, ?array $errors = null)
    {
        return response()->json([
            "success" => false,
            "code" => $code,
            "message" => $message,
            "data" => null,
            "errors" => $errors
        ], $code);
    }
}

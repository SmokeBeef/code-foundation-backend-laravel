<?php

namespace App\Http\Controllers;

use App\Http\DTO\Auth\AuthMutationDTO;
use App\Http\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $payload = $request->all();
            $configs = [
                "input" => $payload
            ];
            $authDTO = new AuthMutationDTO($configs);

            $operation = AuthService::login($authDTO);
            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }
            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());
        } catch (Exception $error) {
            dd($error);
            return self::responseError("internal server error");
        }
    }

    public function logout(Request $request)
    {
        try {

            $operation = AuthService::logout();

            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }
            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $error) {
            return self::responseError("internal server error");
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $operation = AuthService::refreshToken();

            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }
            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());



        } catch (Exception $error) {
            return self::responseError("internal server error");
        }
    }
}

<?php
namespace App\Http\Services;

use App\Http\DTO\Auth\AuthMutationDTO;
use App\Http\Operation\Operation;

class AuthService
{
    public static function login(AuthMutationDTO $authMutationDTO): Operation
    {
        $operation = new Operation();

        if (!$authMutationDTO->isSuccess()) {
            $operation->setIsSuccess(false)
                ->setMessage($authMutationDTO->getMessage())
                ->setErrors($authMutationDTO->getErrors())
                ->setCode($authMutationDTO->getCode());
            return $operation;
        }
        $data = $authMutationDTO->getData();

        // dd($data);
        $token = auth()->attempt([
            "user_email" => $data["user_email"],
            "password" => $data["user_password"]
        ]);
        if (!$token) {
            $operation->setIsSuccess(false)
                ->setMessage("Failed Login, email or password not match")
                ->setCode(401);
            return $operation;
        }

        $tokenExpires = auth()->factory()->getTTL() * 60;

        $result = [
            "token" => $token,
            "expiresIn" => $tokenExpires
        ];

        $operation->setIsSuccess(true)
            ->setMessage("Success Login")
            ->setCode(200)
            ->setResult($result);
        return $operation;
    }

    public static function logout(): Operation
    {

        $operation = new Operation();
        auth()->logout();
        $operation->setIsSuccess(true)
            ->setMessage('success logout')
            ->setCode(200)
            ->setResult(null);
        return $operation;
    }

    public static function refreshToken(): Operation
    {
        $operation = new Operation();

        $token = auth()->refresh();

        $tokenExpires = auth()->factory()->getTTL() * 60;

        $result = [
            "token" => $token,
            "expriseIn" => $tokenExpires
        ];
        $operation->setIsSuccess(true)
            ->setMessage('success get new token')
            ->setResult($result)
            ->setCode(200);

        return $operation;
    }
}
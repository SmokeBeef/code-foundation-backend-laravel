<?php

namespace App\Http\DTO;

use Validator;

class BaseDTO
{
    protected bool $isSuccess;
    protected string $message = '';
    protected array $errors = [];
    protected int $code = 400;



    protected function mutationConfigsValidation(array $inputData, array $validatorRules): array
    {
        $validation = Validator::make($inputData, $validatorRules);

        if ($validation->fails()) {
            return [
                "isSuccess" => false,
                "message" => "Failed, request payload not suitable",
                "data" => [],
                "errors" => $validation->errors()->messages(),
                "code" => 400
            ];
        }

        return [
            "isSuccess" => true,
            "message" => "Success, validation query",
            "data" => $validation->validated(),
            "errors" => [],
            "code" => 200
        ];
    }

    protected function queryConfigsValidation(array $configs, array $validatorRules): array
    {
        $validation = Validator::make($configs, $validatorRules);
        if ($validation->fails()) {
            return [
                "isSuccess" => false,
                "message" => "Failed, request payload not suitable",
                "data" => [],
                "errors" => $validation->errors()->messages(),
                "code" => 400
            ];
        }

        return [
            "isSuccess" => true,
            "message" => "Success, validation query",
            "data" => $validation->validated(),
            "errors" => [],
            "code" => 200
        ];
    }



    public function getMessage()
    {
        return $this->message;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}
<?php 
namespace App\Http\DTO\Auth;
use App\Http\DTO\MutationDTO;


class AuthMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        "user_email" => "required|string|email|max:200",
        "user_password" => "required|string"
    ];
}
<?php
namespace App\Http\DTO\User;
use App\Http\DTO\MutationDTO;

class UserMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        "user_name" => "required|string|max:100",
        "user_address" => "required|string|max:150",
        "user_email" => "required|string|max:50",
        "user_phonenumber" => "required|string|max:13",
        "user_password" => "required|string|max:100",
        "user_isadmin" => "required|boolean",
        
    ];
}
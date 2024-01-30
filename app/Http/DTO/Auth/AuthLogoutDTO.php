<?php 

namespace App\Http\DTO\Auth;
use App\Http\DTO\MutationDTO;


class AuthLogoutDTO extends MutationDTO
{
    protected array $validatorRules = [
        "token" => ""
    ];
}
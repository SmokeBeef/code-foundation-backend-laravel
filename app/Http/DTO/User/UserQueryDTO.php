<?php
namespace App\Http\DTO\User;
use App\Http\DTO\QueryDTO;

class UserQueryDTO extends QueryDTO
{

    protected array $fields = [
        "user_id",
        "user_name",
        "user_address",
        "user_email",
        "user_username",
        "user_phonenumber",
        "user_isadmin",
        "created_at",
    ];
}
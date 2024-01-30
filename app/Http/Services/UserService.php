<?php
namespace App\Http\Services;

use App\Http\DTO\User\UserQueryDTO;
use App\Http\Operation\Operation;
use App\Models\User;

class UserService
{
    public static function store()
    {

    }

    public static function getAll(UserQueryDTO $userQueryDTO): Operation
    {
        $operation = new Operation();

        if (!$userQueryDTO->isSuccess) {
            $operation->setIsSuccess(false)
                ->setMessage($userQueryDTO->getMessage())
                ->setErrors($userQueryDTO->getErrors())
                ->setCode($userQueryDTO->getCode());
            return $operation;
        }

        $column = $userQueryDTO->getFields();
        $limit = $userQueryDTO->getLimit();
        $offset = $userQueryDTO->getOffset();
        $search = $userQueryDTO->getSearch();
        $sort = $userQueryDTO->getSort();
        $between = $userQueryDTO->getBetween();

        $result = User::paginate($column, $limit, $offset, $sort, $between, $search);
        $totalData = User::countResult($search, $between);

        $operation
            ->setPage($userQueryDTO->getPage())
            ->setTotal($totalData)
            ->setPerPage($limit)
            ->setIsSuccess(true)
            ->setResult($result)
            ->setMessage("Success get Alat")
            ->setCode(200);


        return $operation;

    }
}
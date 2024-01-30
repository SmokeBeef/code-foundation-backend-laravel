<?php

namespace App\Http\Controllers;

use App\Http\DTO\User\UserQueryDTO;
use App\Http\Services\UserService;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function index(Request $request)
    {
        try {
            $sortBy = $request->query("sortBy", "created_at");
            $sortOrder = $request->query("sortOrder", "desc");
            $search = $request->query("search", "");
            $start = $request->query("start");
            $end = $request->query("end");
            $column = $request->query("column");
            $group = $request->query("groups");
            $page = $request->query("page", 1);
            $perPage = $request->query("perpage", 25);
            $configs = [
                "page" => $page,
                "perpage" => $perPage,
                "search" => $search,
                "groups" => $group,
                "sort" => [
                    [
                        "order" => "asc",
                        "column" => "boot_title"
                    ],
                    [
                        "order" => "desc",
                        "column" => "author_name"
                    ],
                ],
                "between" => [
                    [
                        "start" => $start,
                        "end" => $end,
                        "column" => $column
                    ]
                ]
            ];

            $userQueryDTO = new UserQueryDTO($configs);

            $operation = UserService::getAll($userQueryDTO);


            if ($operation->isSuccess()) {
                $page = $operation->getPage();
                $perPage = $operation->getPerPage();
                $totalData = $operation->getTotal();
                $totalPage = ceil($totalData / $perPage);
                $pagination = [
                    "page" => $page,
                    "perPage" => $perPage,
                    "totalData" => $totalData,
                    "totalPage" => $totalPage,
                    "links" => [
                        "first" => url()->current() . "?page=" . 1 . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                        "prev" => url()->current() . "?page=" . ($page - 1) . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                        "next" => url()->current() . "?page=" . ($page + 1) . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                        "last" => url()->current() . "?page=" . $totalPage . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",

                    ]
                ];

                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode(), $pagination);
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $error) {
            dd($error);
            return self::responseError("internal error");
        }
    }
    public function store(Request $request)
    {
        try {
            $payload = $request->all();

        } catch (Exception $error) {
            self::responseError("internal error");
        }
    }
}

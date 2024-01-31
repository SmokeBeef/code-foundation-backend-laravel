<?php

namespace App\Http\Controllers;

use App\Http\DTO\Book\BookMutationDTO;
use App\Http\DTO\Book\BookQueryDTO;
use App\Http\Services\BookService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function store(Request $request)
    {
        try {
            $payload = $request->all();
            $config = [
                "input" => $payload
            ];

            $bookMutationDto = new BookMutationDTO($config);

            $operation = BookService::store($bookMutationDto);

            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());
        } catch (Exception $err) {
            dd($err);
            return self::responseError("internal error");
        }
    }

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
                        "column" => "book_title"
                    ],
                    [
                        "order" => "desc",
                        "column" => "author_name"
                    ],
                ],
                "between" => [
                    [
                        "start" => "2020-12-12",
                        "end" => "2025-12-12",
                        "column" => "book_created_at"
                    ]
                ]
            ];

            $queryDTO = new BookQueryDTO($configs);


            $operation = BookService::getAll($queryDTO);

            if ($operation->isSuccess()) {
                // $page = $operation->getPage();
                // $perPage = $operation->getPerPage();
                // $totalData = $operation->getTotal();
                // $totalPage = ceil($totalData / $perPage);
                // $pagination = [
                //     "page" => $page,
                //     "perPage" => $perPage,
                //     "totalData" => $totalData,
                //     "totalPage" => $totalPage,
                //     "links" => [
                //         "first" => url()->current() . "?page=" . 1 . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                //         "prev" => url()->current() . "?page=" . ($page - 1) . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                //         "next" => url()->current() . "?page=" . ($page + 1) . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",
                //         "last" => url()->current() . "?page=" . $totalPage . "&perpage=$perPage&sortBy=$sortBy&sortOrder=$sortOrder&search=$search",

                //     ]
                // ];

                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $err) {
            dd($err);
            return self::responseError("internal error");
        }

    }

    public function show($id)
    {
        try {

            $config = [
                "id" => $id
            ];
            $bookQueryDto = new BookQueryDTO($config);
            $operation = BookService::getById($bookQueryDto);
            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $err) {
            dd($err);
            return self::responseError("internal error");
        }
    }

    public function update($id, Request $request)
    {
        try {
            $payload = $request->all();

            $config = [
                "id" => $id,
                "input" => $payload
            ];

            $bookMutationDTO = new BookMutationDTO($config);

            $operation = BookService::update($bookMutationDTO);
            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $err) {
            dd($err);
            return self::responseError("internal error");
        }

    }

    public function destroy($id)
    {
        try {
            $config = [
                "id" => $id,
                "input" => null
            ];

            $bookMutationDTO = new BookMutationDTO($config);

            $operation = BookService::destroy($bookMutationDTO);
            if ($operation->isSuccess()) {
                return self::responseSuccess($operation->getMessage(), $operation->getResult(), $operation->getCode());
            }

            return self::responseError($operation->getMessage(), $operation->getCode(), $operation->getErrors());

        } catch (Exception $err) {
            dd($err);
            return self::responseError("internal error");
        }
    }
}

<?php
namespace App\Http\Services;

use App\Http\DTO\Book\BookMutationDTO;
use App\Http\DTO\Book\BookQueryDTO;
use App\Http\Operation\Operation;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookService
{
    public static function store(BookMutationDTO $bookMutationDTO): Operation
    {
        $operation = new Operation();

        if (!$bookMutationDTO->isSuccess()) {
            $operation->setIsSuccess(false)
                ->setMessage($bookMutationDTO->getMessage())
                ->setErrors($bookMutationDTO->getErrors())
                ->setCode($bookMutationDTO->getCode());
            return $operation;
        }

        $data = $bookMutationDTO->getData();


        $image = $data["book_image"];

        $imageName = self::getFileName($image);

        $path = 'book-image/' . $imageName;


        $saveImage = self::saveImage($path, $image);

        if (!$saveImage) {
            $operation->setIsSuccess(false)
                ->setMessage("failed create new book, cannot save image")
                ->setCode(500);
            return $operation;
        }


        $data["book_image"] = "storage/" . $path;

        $result = Book::createBook($data);

        $operation->setIsSuccess(true)
            ->setMessage("success create new book")
            ->setCode(201)
            ->setResult($result->toArray());

        return $operation;
    }

    public static function getAll(BookQueryDTO $bookQueryDTO): Operation
    {
        $operation = new Operation();
        if (!$bookQueryDTO->isSuccess()) {

            $operation->setIsSuccess(false)
                ->setMessage($bookQueryDTO->getMessage())
                ->setErrors($bookQueryDTO->getErrors())
                ->setCode($bookQueryDTO->getCode());
            return $operation;
        }

        $field = $bookQueryDTO->getFields();
        $search = $bookQueryDTO->getSearch();
        $limit = $bookQueryDTO->getLimit();
        $sorts = $bookQueryDTO->getSort();
        $between = $bookQueryDTO->getBetween();

        $result = Book::getBook($field, $search, $limit, $sorts, $between);

        $operation->setIsSuccess(true)
            ->setMessage("success get all books")
            ->setCode(200)
            ->setResult($result);
        return $operation;
    }

    public static function getById(BookQueryDTO $bookQueryDTO): Operation
    {
        $operation = new Operation();
        if (!$bookQueryDTO->isSuccess()) {

            $operation->setIsSuccess(false)
                ->setMessage($bookQueryDTO->getMessage())
                ->setErrors($bookQueryDTO->getErrors())
                ->setCode($bookQueryDTO->getCode());
            return $operation;
        }
        $field = $bookQueryDTO->getFields();
        $id = $bookQueryDTO->getId();

        $result = Book::getBookById($field, $id);
        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage("failed get book by id, id not found")
                ->setCode(404);
            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage("success get book by id")
            ->setCode(200)
            ->setResult($result);
        return $operation;
    }


    public static function update(BookMutationDTO $bookMutationDTO)
    {
        $operation = new Operation();

        if (!$bookMutationDTO->isSuccess()) {
            $operation->setIsSuccess(false)
                ->setMessage($bookMutationDTO->getMessage())
                ->setErrors($bookMutationDTO->getErrors())
                ->setCode($bookMutationDTO->getCode());
            return $operation;
        }

        $data = $bookMutationDTO->getData();
        $id = $bookMutationDTO->getId();

        if (count($data) < 1) {
            $operation->setIsSuccess(false)
                ->setMessage("failed update book, at least give one data")
                ->setCode(400);
            return $operation;
        }

        $result = Book::updateBook($id, $data);
        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage("failed update book, id not found")
                ->setCode(404);
            return $operation;
        }
        $operation->setIsSuccess(true)
            ->setMessage("success update book")
            ->setResult($result)
            ->setCode(201);
        return $operation;

    }

    public static function destroy(BookMutationDTO $bookMutationDTO)
    {
        $operation = new Operation();

        if (!$bookMutationDTO->isSuccess()) {
            $operation->setIsSuccess(false)
                ->setMessage($bookMutationDTO->getMessage())
                ->setErrors($bookMutationDTO->getErrors())
                ->setCode($bookMutationDTO->getCode());
            return $operation;
        }

        $id = $bookMutationDTO->getId();

        $result = Book::deleteBook($id);

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage("failed delete book, id not found")
                ->setCode(404);
            return $operation;
        }
        $operation->setIsSuccess(true)
            ->setMessage("success delete book")
            ->setResult($result)
            ->setCode(200);
        return $operation;
    }


    /// private function
    private static function getFileName($file): string
    {
        $filename = Str::uuid() . "-" . $file->getClientOriginalName();
        return $filename;
    }
    private static function saveImage($path, $file): bool
    {
        try {
            Storage::disk("public")->put($path, file_get_contents($file));
            return true;
        } catch (Exception $err) {
            return false;
        }
    }
}
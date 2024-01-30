<?php

namespace App\Http\DTO\Book;

use App\Http\DTO\MutationDTO;
use Illuminate\Validation\Rules\File;

class BookMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        "book_author_id" => "required|exists:authors,author_id",
        "book_publisher_id" => "required|exists:publishers,publisher_id",
        "book_category_id" => "required|exists:categories,category_id",
        "book_shelf_id" => "required|exists:shelfs,shelf_id",
        "book_title" => "required|string|max:150",
        "book_isbn" => "required|string|max:16",
        "book_publicationyear" => "required|regex:/^\d{4}$/",
        "book_image" => "required|file|mimes:jpg,png,jpeg",
    ];
    protected array $validatorRulesUpdate = [
        "book_author_id" => "nullable|exists:authors,author_id",
        "book_publisher_id" => "nullable|exists:publishers,publisher_id",
        "book_category_id" => "nullable|exists:categories,category_id",
        "book_shelf_id" => "nullable|exists:shelfs,shelf_id",
        "book_title" => "nullable|string|max:150",
        "book_isbn" => "nullable|string|max:16",
        "book_publicationyear" => "nullable|regex:/^\d{4}$/",
        "book_image" => "nullable|file|mimes:jpg,png,jpeg",
    ];
}

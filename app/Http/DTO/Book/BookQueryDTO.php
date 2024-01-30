<?php 
namespace App\Http\DTO\Book;
use App\Http\DTO\QueryDTO;

class BookQueryDTO extends QueryDTO
{
    protected array $fields = [
        "book_id",
        "book_author_id",
        "book_category_id",
        "book_publisher_id",
        "book_shelf_id",
        "book_title",
        "book_isbn",
        "book_publicationyear",
        "book_image",
        "book_created_at",
        "authors.author_id",
        "authors.author_name",
        "categories.category_id",
        "categories.category_name",
        "publishers.publisher_id",
        "publishers.publisher_name",
        "shelfs.shelf_id",
        "shelfs.shelf_name",
        "shelfs.shelf_location",
    ];
}
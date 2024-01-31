<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'book_author_id',
        'book_publisher_id',
        'book_category_id',
        'book_shelf_id',
        'book_title',
        'book_isbn',
        'book_publicationyear',
        'book_image'
    ];
    public $timestamps = false;

    public static function getBook(array $fields, string $search, int $limit, array $sorts, array $betweens)
    {
        $books = DB::table('books')
            ->leftJoin('authors', 'books.book_author_id', '=', 'authors.author_id', )
            ->leftJoin('categories', 'books.book_category_id', '=', 'categories.category_id')
            ->leftJoin('publishers', 'books.book_publisher_id', '=', 'publishers.publisher_id')
            ->leftJoin('shelfs', 'books.book_shelf_id', '=', 'shelfs.shelf_id')
            ->select($fields)
            ->where('books.book_title', 'LIKE', '%' . $search . '%');
        foreach ($betweens as $between) {
            if ($between["column"]) {
                $column = DB::raw('DATE(' . $between["column"] . ')');
                $range = [$between["start"], $between["end"]];
                $books->whereBetween($column, $range);

            }
        }
        foreach ($sorts as $sort) {
            $books->orderBy($sort['column'], $sort['order']);
        }

        return $books->paginate($limit)->toArray();
    }

    public static function getBookById(array $fields, string $book_id)
    {
        $book = DB::table('books')
            ->leftJoin('authors', 'books.book_author_id', '=', 'authors.author_id')
            ->leftJoin('categories', 'books.book_category_id', '=', 'categories.category_id')
            ->leftJoin('publishers', 'books.book_publisher_id', '=', 'publishers.publisher_id')
            ->leftJoin('shelfs', 'books.book_shelf_id', '=', 'shelfs.shelf_id')
            ->select($fields)
            ->where('books.book_id', '=', $book_id)
            ->first();

        return (array)$book;
    }

    public static function createBook(array $data): self
    {

        $book = new self($data);

        $book->save();
        return $book;
    }

    public static function updateBook($id, array $data): array|null
    {
        $query = DB::table("books")->select()->where("book_id", "=", $id);


        $result = $query->update($data);

        if (!$result) {
            return null;
        }

        return $query->get()->toArray();
    }

    public static function deleteBook(string $book_id): array|null
    {
        $query = DB::table('books')
            ->where('book_id', '=', $book_id);

        $book = $query->get();

        $result = $query->delete();

        if($result) {
            return $book->toArray();
        }

        return null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->book_id = Str::uuid();
            $model->book_created_at = now();
        });
        static::updating(function ($model) {
            $model->book_updated_at = now();
        });
    }
}

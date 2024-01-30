<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';
    protected $fillable = [
        'author_name',
        'author_birthplace',
        'author_birthdate'
    ];
    protected $casts = [
        'author_id' => 'string'
    ];
}
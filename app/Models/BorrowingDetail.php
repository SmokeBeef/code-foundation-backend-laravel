<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetailModel extends Model
{
    use HasFactory;

    protected $table = 'borrowing_details';
    protected $primaryKey = 'borrowing_detail_id';
    protected $fillable = [
        'borrowing_detail_borrowing_id',
        'borrowing_detail_book_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingModel extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $primaryKey = 'borrowing_id';
    protected $fillable = [
        'borrowing_user_id',
        'borrowing_borrowdate',
        'borrowing_returndate',
        'borrowing_returnstatus',
        'borrowing_note',
        'borrowing_penaltys'
    ];
}

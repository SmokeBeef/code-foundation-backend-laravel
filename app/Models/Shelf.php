<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelfModel extends Model
{
    use HasFactory;

    protected $table = 'shelfs';
    protected $primaryKey = 'shelf_id';
    protected $fillable = [
        'shelf_name',
        'shelf_location',
        'shelf_capacity'
    ];
    protected $casts = [
        'shelf_id' => 'string'
    ];
}

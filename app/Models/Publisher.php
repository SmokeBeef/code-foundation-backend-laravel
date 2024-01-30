<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherModel extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'publisher_id';
    protected $fillable = [
        'publisher_name',
        'publisher_address',
        'publisher_email',
        'publisher_phonenumber'
    ];
    protected $casts = [
        'publisher_id' => 'string'
    ];
}

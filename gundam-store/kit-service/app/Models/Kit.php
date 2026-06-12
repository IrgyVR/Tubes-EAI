<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'price',
        'stock'
    ];
}

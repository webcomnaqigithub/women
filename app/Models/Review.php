<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'mshop_review';
    protected $fillable = [
        'siteid',
        'domain',
        'refid',
        'customerid',
        'ordprodid',
        'name',
        'status',
        'rating',
        'comment',
        'response',
    ];
}

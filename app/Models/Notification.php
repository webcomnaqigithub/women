<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'receiver_name',
        'receiver_image',
        'content',
        'product_name',
        'path',
        'status',
        'viewed',
    ];
}

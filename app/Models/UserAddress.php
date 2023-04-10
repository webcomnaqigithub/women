<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'users_address';
    protected $fillable = [
        'siteid',
        'parentid',
        'company',
        'vatid',
        'salutation',
        'title',
        'firstname',
        'lastname',
        'lastname',
        'address1',
        'address2',
        'address3',
        'postal',
        'city',
        'state',
        'countryid',
        'telephone',
        'telefax',
        'email',
        'website',
        'pos',
        'mtime',
        'ctime',
        'editor',
        'default',
    ];
    public $timestamps = false;

}

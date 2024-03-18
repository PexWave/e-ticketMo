<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClientType extends Model
{
    use HasFactory;

    public $table = 'user_client_types';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'client_type_id',
    ];
}

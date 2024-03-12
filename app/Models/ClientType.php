<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    use HasFactory;

    public $table = 'client_types';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'importance',
        'office_id',
    ];
}

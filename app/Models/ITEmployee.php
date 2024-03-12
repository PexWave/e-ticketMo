<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITEmployee extends Model
{
    use HasFactory;
    public $table='it_employees';
    
    protected $fillable = [
        'user_id',
        'staff_status',
    ];
}

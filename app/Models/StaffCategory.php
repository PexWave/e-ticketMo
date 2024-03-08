<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    use HasFactory;

    public $table = 'staff_categories';

    protected $fillable = [
        'category_id',
        'it_employee_id',
    ] ;
}

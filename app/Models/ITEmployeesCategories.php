<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITEmployeesCategories extends Model
{
    use HasFactory;

    public $table = 'it_employees_categories';
    public $timestamps = false;
    
    protected $fillable = [
        'employee_id',
        'category_id',
    ];
}

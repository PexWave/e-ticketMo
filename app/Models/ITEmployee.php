<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ITEmployee extends Model
{
    use HasFactory;

    public $table = 'it_employees';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'staff_status',
    ];

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class, 'staff_categories', 'it_employee_id', 'category_id');
    }

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }
}

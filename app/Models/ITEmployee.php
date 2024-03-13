<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ITEmployee extends Model
{
    use HasFactory;
    public $table='it_employees';
    
    protected $fillable = [
        'user_id',
        'staff_status',
    ];

    public function category(): BelongsToMany{
        return $this->belongsToMany(Category::class, 'user_client_types');
    }
}

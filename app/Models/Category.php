<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];

    public function it_employee(): BelongsToMany{
        return $this->belongsToMany(ITEmployee::class);
    }

}


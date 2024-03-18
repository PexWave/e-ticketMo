<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskType extends Model
{
    use HasFactory;
    public $table= 'task_types';

    public $timestamps=false;

    protected $fillable = [
        'task',
        'category_id',
        'difficulty',
        'urgency',
        'response_time',
        'resolve_time',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
    

    
    
}

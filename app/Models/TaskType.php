<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

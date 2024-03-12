<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $table='tickets';
    
    protected $fillable = [
        'user_id',
        'ticket_status',
        'actual_response',
        'actual_resolve',
        'modified_date',
        'reference_date',
        'remarks',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    public $table = 'tickets';

    public $timestamps = false;

    
    protected $fillable = [
        'user_id',
        'ticket_status',
        'actual_response',
        'actual_resolve',
        'modified_date',
        'reference_date',
        'remarks',
        'task_type_id',
        'assigned_to',
        'transferred_to',
        'transferred_by',
        'new_resolve',
        'transfer_ticket_date',
        'ticket_number',
    ];

    public function extension_requests(): HasMany
    {
        return $this->hasMany(ExtensionRequest::class);
    }
    

    public function task_type(): BelongsTo
    {
        return $this->belongsTo(TaskType::class);
    }
    
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
}

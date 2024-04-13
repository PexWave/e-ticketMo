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
        'user_client_type_id',
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
    ];

    public function extension_requests(): HasMany
    {
        return $this->hasMany(ExtensionRequest::class);
    }
    

    public function task_type(): BelongsTo
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }
    
    public function it_employee(): BelongsTo
    {
        return $this->belongsTo(ITEmployee::class, 'assigned_to');
    }
    
    public function client_type(): BelongsTo
    {
        return $this->belongsTo(UserClientType::class, 'user_client_type_id');
    }
    

}
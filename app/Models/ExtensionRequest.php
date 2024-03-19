<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtensionRequest extends Model
{
    use HasFactory;

    public $table = "extension_requests";
    public $timestamps = false;


    protected $fillable = [
        'ticket_id',
        'extension_time',
        'approved_by',
        'requested_by',
        'requested_date',
        'reason',
    ] ;

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}

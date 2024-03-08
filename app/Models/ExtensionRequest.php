<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionRequest extends Model
{
    use HasFactory;

    public $table = "extension_requests";

    protected $fillable = [
        'ticket_id',
        'extension_time',
        'approved_by',
        'requested_by',
        'requested_date',
        'reason',

    ] ;
}

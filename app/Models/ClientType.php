<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientType extends Model
{
    use HasFactory;

    public $table = 'client_types';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'importance',
        'office_id',
    ];

    public function user(): HasMany{
        return $this->hasMany(User::class, 'user_client_types');
    }
}

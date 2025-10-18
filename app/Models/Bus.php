<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    protected $fillable = [
        'route_id',
        'name',
    ];

    /**
     * Get the route that owns the bus.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Get the chats for the bus.
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
}

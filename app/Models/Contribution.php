<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contribution extends Model
{
    protected $fillable = [
        'user_id',
        'route_id',
        'type',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    /**
     * Get the user that owns the contribution.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the route that owns the contribution.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }
}

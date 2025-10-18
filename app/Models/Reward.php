<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
        ];
    }

    /**
     * Get the user that owns the reward.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

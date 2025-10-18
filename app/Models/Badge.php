<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'points_required',
        'icon',
    ];

    protected function casts(): array
    {
        return [
            'points_required' => 'integer',
        ];
    }

    /**
     * Get the user badges for the badge.
     */
    public function userBadges(): HasMany
    {
        return $this->hasMany(UserBadge::class);
    }
}

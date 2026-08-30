<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Occurrence extends Model
{
    protected $fillable = [
        'title',
        'description',
        'totem_model_id',
        'order_number',
        'serial_number',
        'created_by',
        'sector_id',
        'assigned_user_id',
        'priority',
        'status',
        'started_at',
        'resolved_at',
        'closed_at',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    protected function casts(): array
{
    return [
        'started_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];
}

public function histories(): HasMany
{
    return $this->hasMany(OccurrenceHistory::class)
        ->orderBy('created_at');
}

public function getTotalHoursAttribute(): ?float
{
    if (! $this->closed_at) {
        return null;
    }

    return $this->created_at->diffInMinutes($this->closed_at) / 60;
}

public function getTotalDurationAttribute(): ?string
{
    if (! $this->closed_at) {
        return null;
    }

    $minutes = $this->created_at->diffInMinutes($this->closed_at);

    $hours = intdiv($minutes, 60);
    $remainingMinutes = $minutes % 60;

    return "{$hours}h {$remainingMinutes}min";
}
}

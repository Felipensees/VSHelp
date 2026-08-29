<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionItem extends Model
{
    protected $fillable = [
        'inspection_section_id',
        'name',
        'sort_order',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(InspectionSection::class, 'inspection_section_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(InspectionAnswer::class);
    }
}
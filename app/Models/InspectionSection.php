<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionSection extends Model
{
    protected $fillable = [
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

    public function items(): HasMany
    {
        return $this->hasMany(InspectionItem::class)
            ->orderBy('sort_order');
    }
}
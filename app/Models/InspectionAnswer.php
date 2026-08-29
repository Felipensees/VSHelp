<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionAnswer extends Model
{
    protected $fillable = [
        'totem_inspection_id',
        'inspection_item_id',
        'result',
    ];

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(
            TotemInspection::class,
            'totem_inspection_id'
        );
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            InspectionItem::class,
            'inspection_item_id'
        );
    }
}
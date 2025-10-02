<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'status',
        'location',
        'description',
        'step_date',
    ];

    protected $casts = [
        'step_date' => 'datetime',
    ];

    // العلاقة: خطوة التتبع تعود لشحنة واحدة
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}

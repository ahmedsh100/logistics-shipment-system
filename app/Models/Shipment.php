<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// يمثل نموذج الشحنات
class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'customer_id',
        'status',
        'amount',
        'description',
    ];

    // الحالات المسموح بها للشحنة
    public const STATUSES = [
        'new',
        'in_transit',
        'delivered',
        'delayed',
    ];

    // العلاقة: الشحنة تعود لعميل واحد
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // العلاقة: الشحنة لديها العديد من خطوات التتبع
    public function steps(): HasMany
    {
        return $this->hasMany(ShipmentStep::class)->orderBy('created_at', 'desc');
    }
}

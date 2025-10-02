<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // نستخدم Authenticatable للمصادقة
use Illuminate\Database\Eloquent\Relations\HasMany;

// يمثل نموذج العملاء (المستخدمين النهائيين الذين يسجلون في النظام)
class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // العلاقة: العميل لديه العديد من الشحنات
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// يمثل نموذج المستخدمين (Admin)
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * الحقول التي يمكن ملؤها جماعياً.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * الحقول التي يجب إخفاؤها عند التحويل إلى مصفوفة/JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * السمات التي يجب تحويلها.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

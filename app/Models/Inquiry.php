<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// يمثل نموذج استفسارات العملاء
class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}

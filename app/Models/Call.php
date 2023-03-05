<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Call\Status as CallStatus;

class Call extends Model
{
    use HasFactory;
    use SoftDeletes;
//    protected $guarded = [];
    protected $fillable = [
        'name',
        'tel',
    ];

    // касты
    protected $casts = [
       'status' => CallStatus::class,
    ];
}

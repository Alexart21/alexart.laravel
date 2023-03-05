<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Post\Status as PostStatus;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

//    protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'tel',
        'body'
    ];

    // касты
    protected $casts = [
        'status' => PostStatus::class,
    ];
}

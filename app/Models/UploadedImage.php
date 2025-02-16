<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedImage extends Model
{

     protected $fillable = ['user_session_id', 'name'];

//     protected $casts = [
//        'published_at' => 'datetime',
//    ];
}

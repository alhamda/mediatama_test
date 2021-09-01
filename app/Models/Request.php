<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'video_id', 'until_date', 'status'];

    public function video(){
        return $this->belongsTo(Video::class);
    }

    public function customer(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

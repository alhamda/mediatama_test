<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'file'];
    protected $appends = ['can_access', 'video_url'];

    public function requests(){
        return $this->hasMany(Request::class, 'video_id', 'id');
    }

    public function getVideoUrlAttribute(){
        return \Storage::url($this->file);
    }

    public function getCanAccessAttribute(){
        $request = Request::where('video_id', $this->id)
                        ->where('user_id', Auth::id())
                        ->orderBy('id', 'DESC')
                        ->first();

        if(!is_null($request)){
            return $request->status == 'accept' && \Carbon\Carbon::parse($request->until_date)->isPast()==false;
        }else{
            return false;
        }
    }
}

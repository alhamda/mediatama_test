<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Request as Req;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index(){
        $videos = Video::orderBy('title')->get();
        return view('customer.video.index', compact('videos'));
    }

    public function show(Video $video){
        if($video->can_access){
            return view('customer.video.show', compact('video'));
        }else{
            abort(403, 'Anda tidak memiliki akses untuk video ini');
        }
    }

    public function request(Video $video){
        $user_id = Auth::id();

        DB::beginTransaction();
        try{

            $request = Req::where('video_id', $video->id)
                        ->where('user_id', $user_id)
                        ->where('status', 'waiting')
                        ->orderBy('id', 'DESC')
                        ->first();

            if(is_null($request)){

                Req::create([
                    'user_id' => $user_id,
                    'video_id' => $video->id,
                    'status' => 'waiting',
                    'until_date' => null,
                ]);

            }

            DB::commit();

            return redirect()
                    ->route('customer.videos.index')
                    ->with('success', 'Permintaan hak akses video berhasil diajukan');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Permintaan hak akses gagal karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }


    }
}

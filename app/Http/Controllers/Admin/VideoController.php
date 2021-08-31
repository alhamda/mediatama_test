<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('title')->get();
        return view('admin.video.index', compact('videos'));
    }


    public function create()
    {
        return view('admin.video.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'file' => 'required|file|max:10240',
        ]);

        DB::beginTransaction();
        try{

            $path = $request->file('file')->storeAs(
                'public/videos', time().'.'.$request->file('file')->getClientOriginalExtension(),
            );

            $data = $request->except('file');
            $data['file'] = $path;

            Video::create($data);
            DB::commit();

            return redirect()
                    ->route('admin.videos.index')
                    ->with('success', 'Data video berhasil ditambahkan');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data video gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }


    public function update(Request $request, Video $video)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'file' => 'nullable|file|max:10240',
        ]);

        DB::beginTransaction();
        try{
            $data = $request->except('file');

            if($request->hasFile('file')){
                $path = $request->file('file')->storeAs(
                    'public/videos', time().'.'.$request->file('file')->getClientOriginalExtension(),
                );

                $data['file'] = $path;
            }

            $video->update($data);
            DB::commit();

            return redirect()
                    ->route('admin.videos.index')
                    ->with('success', 'Data video berhasil diubah');

        }catch(Exception $e){
            DB::rollback();

            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data video gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function destroy(Video $video)
    {
        DB::beginTransaction();
        try{

            $video->delete();
            DB::commit();

            return redirect()
                    ->route('admin.videos.index')
                    ->with('success', 'Data video berhasil dihapus');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data video gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }
}

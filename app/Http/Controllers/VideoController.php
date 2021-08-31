<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'file' => 'required',
        ]);


        DB::beginTransaction();
        try{

            Video::create($request->all());
            DB::commit();

            return redirect()
                    ->route('admin.video.index')
                    ->with('success', 'Data video berhasil ditambahkan');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data video gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'file' => 'required',
        ]);

        DB::beginTransaction();
        try{

            $video->update($request->all());
            DB::commit();

            return redirect()
                    ->route('admin.video.index')
                    ->with('success', 'Data video berhasil diubah');

        }catch(Exception $e){
            DB::rollback();

            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data video gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        DB::beginTransaction();
        try{

            $video->delete();
            DB::commit();

            return redirect()
                    ->route('admin.video.index')
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

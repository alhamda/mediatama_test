<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as Req;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Req::orderBy('created_at', 'DESC')
                        ->paginate(20);

    }

   public function decline(Req $req){
        $req->status = 'decline';
        $req->update();

        return redirect()
            ->back()
            ->with('success', 'Permintaan berhasil ditolak');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Req $req)
    {
        DB::beginTransaction();
        try{

            $req->delete();
            DB::commit();

            return redirect()
                    ->route('admin.request.index')
                    ->with('success', 'Data permintaan berhasil dihapus');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data permintaan gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }
}

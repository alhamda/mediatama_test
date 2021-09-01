<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as Req;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                        ->where('status', 'waiting')
                        ->get();
        return view('admin.request.index', compact('requests'));
    }

    public function show(Req $req){
        return view('admin.request.show', compact('req'));
    }

    public function accept(Request $request, Req $req){
        DB::beginTransaction();
        try{

            $this->validate($request, [
                'time' => 'required|numeric|min:1|max:100',
            ]);

            $req->status = 'accept';
            $req->until_date = Carbon::now()->addHours($request->time);
            $req->save();

            DB::commit();

            return redirect()
                    ->route('admin.requests.index')
                    ->with('success', 'Permintaan akses video berhasil diterima');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data permintaan gagal diterima karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }

    public function destroy(Req $req)
    {
        DB::beginTransaction();
        try{

            $req->delete();
            DB::commit();

            return redirect()
                    ->route('admin.requests.index')
                    ->with('success', 'Data permintaan berhasil ditolak');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data permintaan gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }
}

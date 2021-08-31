<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'password' => 'nullable|min:6|max:16',
            'email' => 'required|email|max:200|unique:users,email',
            'phone' => 'required|max:13',
            'address' => 'required|max:200',
        ]);


        DB::beginTransaction();
        try{

            $data = $request->except('password');
            $data['password'] = bcrypt($request->password);
            $data['level'] = 'admin';

            User::create($data);
            DB::commit();

            return redirect()
                    ->route('admin.users.index')
                    ->with('success', 'Data user berhasil ditambahkan');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data user gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function edit(User $user)
    {
        return view('admin.admin.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'password' => 'nullable|min:6|max:16',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|max:13',
            'address' => 'required|max:200',
        ]);


        DB::beginTransaction();
        try{
            $data = $request->except('password');

            if($request->password){
                $data['password'] = bcrypt($request->password);
            }

            $data['level'] = 'admin';

            $user->update($data);
            DB::commit();

            return redirect()
                    ->route('admin.users.index')
                    ->with('success', 'Data user berhasil diubah');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data user gagal diubah karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function destroy(User $user)
    {
        DB::beginTransaction();
        try{

            $user->delete();
            DB::commit();

            return redirect()
                    ->route('admin.users.index')
                    ->with('success', 'Data user berhasil dihapus');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data user gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }
}

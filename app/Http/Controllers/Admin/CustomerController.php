<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = User::orderBy('name')->where('level', 'customer')->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer.create');
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
            $data['level'] = 'customer';

            User::create($data);
            DB::commit();

            return redirect()
                    ->route('admin.customers.index')
                    ->with('success', 'Data customer berhasil ditambahkan');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data customer gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function edit(User $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }


    public function update(Request $request, User $customer)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'password' => 'nullable|min:6|max:16',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users')->ignore($customer->id),
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

            $data['level'] = 'customer';

            $customer->update($data);
            DB::commit();

            return redirect()
                    ->route('admin.customers.index')
                    ->with('success', 'Data customer berhasil diubah');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data customer gagal diubah karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }


    public function destroy(User $customer)
    {
        DB::beginTransaction();
        try{

            $customer->delete();
            DB::commit();

            return redirect()
                    ->route('admin.customers.index')
                    ->with('success', 'Data customer berhasil dihapus');

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('fail', 'Data customer gagal ditambahkan karena terjadi kesalahan : <br><br>'.$e->getMessage());
        }
    }
}

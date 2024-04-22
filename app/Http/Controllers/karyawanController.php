<?php

namespace App\Http\Controllers;

use App\Models\UnitBisnis;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class karyawanController extends Controller
{
    public function index()
    {
        $pageConfigs = ['layoutWidth' => 'full'];
        $karyawan = User::all();
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], 
            ['name' => "Karyawan"],
        ];
        return view('/home/karyawan/index', ['karyawan' => $karyawan, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }
    
    public function create()
    {
        $pageConfigs = ['layoutWidth' => 'full'];
        $unit = UnitBisnis::where('status', '=', '1' )
        ->get();
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], 
            ['link' => "karyawan/index",'name'=>"Karyawan"], 
            ['name' => "Tambah"]
        ];
        return view('/home/karyawan/tambah', ['unit' => $unit, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }
    
     public function store(Request $request)
     {
 
        try {
            $customMessages = [
                'required' => 'Kolom :attribute harus diisi.',
                'unique' => 'Kolom :attribute sudah digunakan.',
                'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
                'min' => [
                    'string' => 'Kolom :attribute minimal harus :min karakter.',
                    'numeric' => 'Kolom :attribute minimal harus :min.',
                ],
                'date' => 'Kolom :attribute harus berupa tanggal.',
                'after_or_equal' => 'Kolom :attribute harus setelah atau sama dengan tanggal :date.',
    
            ];
        
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'mulai_kontrak' => 'required|date',
                'selesai_kontrak' => 'required|date|after_or_equal:mulai_kontrak',
                'unit_bisnis' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'nik' => 'required|string|max:255',
                'no_telp' => 'required|string|max:255',
                'gender' => 'required',
                'status' => 'required',
                'alamat' => 'required|string|max:255',
                'nama_emergency' => 'required|string|max:255',
                'hubungan' => 'required|string|max:255',
                'no_telp_emergency' => 'required|string|max:255',
            ], $customMessages); 
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
             $namaFoto = null;
         
             if ($request->hasFile('foto')) {
                 $foto = $request->file('foto');
                 $namaFoto = time().'.'.$foto->getClientOriginalExtension();
                 $lokasiSimpan = public_path('uploads/foto');
                 $foto->move($lokasiSimpan, $namaFoto);
             }
         
             $user = new User();
             if ($namaFoto) {
                 $user->foto = $namaFoto; 
             }
             $user->name = $request->input('name');
             $user->email = $request->input('email');
             $user->password = Hash::make($request->input('password')); 
             $user->mulai_kontrak = $request->input('mulai_kontrak');
             $user->selesai_kontrak = $request->input('selesai_kontrak');
             $user->unit_bisnis = $request->input('unit_bisnis');
             $user->jabatan = $request->input('jabatan');
             $user->nik = $request->input('nik');
             $user->no_telp = $request->input('no_telp');
             $user->gender = $request->input('gender');
             $user->status = $request->input('status');
             $user->alamat = $request->input('alamat');
             $user->nama_emergency = $request->input('nama_emergency');
             $user->hubungan = $request->input('hubungan');
             $user->no_telp_emergency = $request->input('no_telp_emergency');
             $user->save();
         
             return redirect()->route('karyawan.index')->with('tambah', 'Data Karyawan Berhasil Di tambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.tambah')->with('eror', 'Data Karyawan Gagal Di tambahkan.');
        }

     }
      
     public function edit($id)

     {
         $karyawan = User::find($id); 
         $pageConfigs = ['layoutWidth' => 'full'];

         $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], 
            ['link' => "karyawan/index",'name'=>"Karyawan"], 
            ['name' => "Edit"]
        ];
     
         return view('home.karyawan.edit', compact('karyawan', 'pageConfigs', 'breadcrumbs'));
     }

    public function update(Request $request, $id)
    {

        try {
            $customMessages = [
                'required' => 'Kolom :attribute harus diisi.',
                'unique' => 'Kolom :attribute sudah digunakan.',
                'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
                'min' => [
                    'string' => 'Kolom :attribute minimal harus :min karakter.',
                    'numeric' => 'Kolom :attribute minimal harus :min.',
                ],
                'date' => 'Kolom :attribute harus berupa tanggal.',
                'after_or_equal' => 'Kolom :attribute harus setelah atau sama dengan tanggal :date.',
    
            ];
        
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($id),
                ],
                'password' => 'required|string|min:8',
                'mulai_kontrak' => 'required|date',
                'selesai_kontrak' => 'required|date|after_or_equal:mulai_kontrak',
                'unit_bisnis' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'nik' => 'required|string|max:255',
                'no_telp' => 'required|string|max:255',
                'gender' => 'required',
                'status' => 'required',
                'alamat' => 'required|string|max:255',
                'nama_emergency' => 'required|string|max:255',
                'hubungan' => 'required|string|max:255',
                'no_telp_emergency' => 'required|string|max:255',
            ], $customMessages); 
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $namaFoto = null;
         
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $namaFoto = time().'.'.$foto->getClientOriginalExtension();
                $lokasiSimpan = public_path('uploads/foto');
                $foto->move($lokasiSimpan, $namaFoto);
            }
        
            $user = User::findOrFail($id); 
    
            if ($namaFoto) {
                $user->foto = $namaFoto; 
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password')); 
            $user->mulai_kontrak = $request->input('mulai_kontrak');
            $user->selesai_kontrak = $request->input('selesai_kontrak');
            $user->unit_bisnis = $request->input('unit_bisnis');
            $user->jabatan = $request->input('jabatan');
            $user->nik = $request->input('nik');
            $user->no_telp = $request->input('no_telp');
            $user->gender = $request->input('gender');
            $user->status = $request->input('status');
            $user->alamat = $request->input('alamat');
            $user->nama_emergency = $request->input('nama_emergency');
            $user->hubungan = $request->input('hubungan');
            $user->no_telp_emergency = $request->input('no_telp_emergency');
            $user->save();
        
            return redirect()->route('karyawan.index')->with('edit', 'Data Karyawan Berhasil Di Update.');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.edit')->with('eror', 'Data Karyawan Gagal Di Update.');
        }
      
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id); 
        $user->delete();
        return redirect()->route('karyawan.index')->with('delete', 'Data karyawan Berhasil Di Hapus.');

    }
}


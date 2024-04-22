<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class ruangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::all();
        $ruang = new Ruang();
        $pageConfigs = ['layoutWidth' => 'full'];
    
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "Ruang"], 
        ];
        return view('/home/ruang/index', ['ruangs' => $ruangs, 'ruang' => $ruang, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'jenis' => 'required|string|in:Indoor,Outdoor',
                'tempat' => 'required|string|max:255',
            ]);
      
            $ruang = new Ruang(); 
            $ruang->nama = $request->nama;
            $ruang->jenis = $request->jenis;
            $ruang->tempat = $request->tempat;
        
            $ruang->save();
            return redirect()->route('ruang.index')->with('tambah', 'Data Ruang Berhasil Di Tambahkan'); 
        } catch (\Throwable $th) {
            return redirect()->route('ruang.index')->with('eror', 'Data Ruang Gagal Di Tambahkan'); 
        }
    
    }

    public function edit($id)
    {
        $ruang = Ruang::find($id); 
        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], 
            ['link' => "ruang/index", 'name' => "Ruang"], 
            ['name' => "Edit"] 
        ];

        return view('home.ruang.edit', compact('ruang', 'pageConfigs', 'breadcrumbs'));
    } 

    public function update(Request $request, $id)
    {
        try {
            $ruang = Ruang::findOrFail($id); 
        
            $request->validate([
                'nama' => 'required|string|max:255',
                'jenis' => 'required|string|in:Indoor,Outdoor',
                'tempat' => 'required|string|max:255',
            ]);
        
            $ruang = Ruang::findOrFail($id); 
            $ruang->nama = $request->nama;
            $ruang->jenis = $request->jenis;
            $ruang->tempat = $request->tempat;
        
            $ruang->save();
            return redirect()->route('ruang.index')->with('edit', 'Data Ruang Berhasil Di Update');      
        } catch (\Throwable $th) {
            return redirect()->route('ruang.edit', $id)->with('eror', 'Data Ruang Gagal Di Update');      
        }
       
    }

    public function destroy($id)
    {
        $ruang = Ruang::findOrFail($id);
    
        $ruang->delete();
    
        return redirect()->route('ruang.index')->with('delete', 'Data Ruang Berhasil Di hapus.');
    }

    public function off($id)
    {
        $ruang = Ruang::findOrFail($id);

        $ruang->status = 0;
        $ruang->save();
    
        return redirect()->route('ruang.index')->with('off', 'Data ruang Berhasil Di Nonaktifkan.');
    }

    public function on($id)
    {
        $ruang = Ruang::findOrFail($id);
    
        $ruang->status = 1;
        $ruang->save();
    
        return redirect()->route('ruang.index')->with('on', 'Data ruang Berhasil Di Aktifkan.');
    }

    
}

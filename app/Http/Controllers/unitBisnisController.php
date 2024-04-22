<?php

namespace App\Http\Controllers;

use App\Models\UnitBisnis;
use Illuminate\Http\Request;

class unitBisnisController extends Controller
{
    public function index()
    {
        $unit = UnitBisnis::all();
        
        $pageConfigs = ['layoutWidth' => 'full'];
    
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "Unit Bisnis"], 
        ];
        return view('/home/unit/index', ['unit' => $unit, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
          
            $unit = new UnitBisnis(); 
            $unit->nama = $request->nama;
        
            $unit->save();
            return redirect()->route('unit.index')->with('tambah', 'Data unit Berhasil Di Tambahkan'); 
        } catch (\Throwable $th) {
            return redirect()->route('unit.index')->with('eror', 'Data unit Gagal Di Tambahkan'); 
        }
    
    }

    public function edit($id)
    {
        $unit = UnitBisnis::find($id);
        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "Unit Bisnis"], 
        ];

        return view('home.unit.edit', compact('unit', 'pageConfigs', 'breadcrumbs'));
    } 

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
          
            $unit = UnitBisnis::find($id);
            $unit->nama = $request->nama;
        
            $unit->save();
            return redirect()->route('unit.index')->with('tambah', 'Data unit Berhasil Di Update'); 
        } catch (\Throwable $th) {
            return redirect()->route('unit.index')->with('eror', 'Data unit Gagal Di Update'); 
        }  
    }

    
    public function destroy($id)
    {
        $unit = UnitBisnis::findOrFail($id);
    
        $unit->delete();
    
        return redirect()->route('unit.index')->with('delete', 'Data unit Berhasil Di hapus.');
    }

    public function off($id)
    {
        $unit = UnitBisnis::findOrFail($id);

        $unit->status = 0;
        $unit->save();
    
        return redirect()->route('unit.index')->with('off', 'Data unit Berhasil Di Nonaktifkan.');
    }

    public function on($id)
    {
        $unit = UnitBisnis::findOrFail($id);
    
        $unit->status = 1;
        $unit->save();
    
        return redirect()->route('unit.index')->with('on', 'Data unit Berhasil Di Aktifkan.');
    }
    
}

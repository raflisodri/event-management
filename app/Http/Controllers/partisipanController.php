<?php

namespace App\Http\Controllers;

use App\Models\Partisipan;
use Illuminate\Http\Request;

class partisipanController extends Controller
{
    public function tambahPartisipan(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk melakukan aksi ini.');
        }

        $userParticipating = Partisipan::where('user_id', auth()->user()->id)
                                        ->where('acara_id', $request->acara_id)
                                        ->exists();

        if ($userParticipating) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar sebagai partisipan dalam acara ini.');
        }

        $partisipan = new Partisipan();
        $partisipan->user_id = auth()->user()->id; 
        $partisipan->acara_id = $request->acara_id;
        $partisipan->save();

        return redirect()->back()->with('ikuti', 'Anda berhasil bergabung sebagai partisipan.');
    }

    public function hapusPartisipan(Request $request)
    {
        Partisipan::where('acara_id', $request->acara_id)
                  ->where('user_id', auth()->user()->id)
                  ->delete();

        return redirect()->back()->with('tidak', 'Anda berhasil Mengubah status sebagai partisipan.');
    }    

    public function store(Request $request)
    {

        foreach ($request->user_id as $user_id) {
            Partisipan::create([
                'acara_id' => $request->acara_id,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back()->with('success', 'Partisipan berhasil ditambahkan.');
    }
    public function delete($id)
    {

      $partisipan = Partisipan::findOrFail($id);
    
      $partisipan->delete();

        return redirect()->back()->with('tidak', 'Anda berhasil Mengubah status sebagai partisipan.');
    }    

}

<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\DetailTempat;
use App\Models\Partisipan;
use App\Models\Ruang;
use App\Models\User;
use Telegram\Bot\Api;
use Carbon\Carbon;
use Illuminate\Http\Request;

class acaraController extends Controller
{
    public function index()
    {
        $acara = Acara::all();
        $user = User::all();
        $ruang = Ruang::where('status', '=', '1')->get();

        foreach ($acara as $data) {
            $data->wk_res = $data->wk_res;
        }

        foreach ($acara as $data) {
            $data->userParticipating = Partisipan::where('user_id', auth()->user()->id)
                                                  ->where('acara_id', $data->id)
                                                  ->exists();
        }

        foreach ($acara as $data) {
            $data->participantCount = Partisipan::where('acara_id', $data->id)->count();
        }

        $pageConfigs = ['layoutWidth' => 'full'];
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "Layouts"], ['name' => "Layout Full"]
        ];
    
        return view('/home/event/index', compact('acara', 'user', 'ruang', 'pageConfigs', 'breadcrumbs'));
    }
    

    public function store(Request $request)
    {
        // dd($request);
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tgl_acara' => 'required|date',
                'wk_awal' => 'required|date_format:H:i',
                'wk_akhir' => 'required|date_format:H:i',
                'wk_res' => 'required|date',
                'koordinator' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ]);

            $validatedData['tgl_acara'] = date('Y-m-d', strtotime($validatedData['tgl_acara']));
            $validatedData['wk_res'] = date('Y-m-d', strtotime($validatedData['wk_res']));
            $validatedData['wk_awal'] = date('H:i', strtotime($validatedData['wk_awal']));
            $validatedData['wk_akhir'] = date('H:i', strtotime($validatedData['wk_akhir']));
    
            $acara = new Acara($validatedData);
            $acara->save();

            foreach ($request->tempat as $tempat) {
                $detailTempat = new DetailTempat([
                    'id_acara' => $acara->id,
                    'tempat' => $tempat,
                ]);
                $detailTempat->save();
            }
            $koordinatorInfo = User::findOrFail($validatedData['koordinator']);
            $koordinatorName = $koordinatorInfo->name;
            $gender = $koordinatorInfo->gender;

            $titlePrefix = ($gender == 'pria') ? '<b>Kang</b>' : '<b>Teh</b>';
            $koordinator = '<b>'.$koordinatorName.'</b>';

            $tempatArray = $request->tempat;
            $namaRuangList = [];
            foreach ($tempatArray as $id_ruang) {
                $namaRuang = Ruang::findOrFail($id_ruang)->nama;
                $namaRuangList[] = $namaRuang;
            }
            $tempatList = implode(', ', $namaRuangList); 

            $judul = $validatedData['judul'];
            $tgl_acara = date('d F Y', strtotime($validatedData['tgl_acara']));
            $wk_res = date('d F Y', strtotime($validatedData['wk_res']));
            $koordinator = $koordinatorName;
    
            $text = "Halo Akang Teteh Kabayan Group, {$titlePrefix} <b>{$koordinator}</b>, telah membuat acara dengan judul, '{$judul}', Acara ini akan berlangsung pada {$tgl_acara}, dan akan berlangsung di : <b>{$tempatList}</b>. Jangan lupa untuk reservasi di Siiteung ya, karena reservasi ditutup pada tanggal {$wk_res}.  ";

            $telegram = new Api('6997727713:AAHj23NnCJ2J7KtMTqix3t5QHJZm5SnwIpg');
            $telegram->sendMessage([
                'chat_id' => '-4185272479',
                'text' => $text,
                'parse_mode' => 'HTML'
            ]);

            return redirect()->route('event.index')->with('tambah', 'Data Acara Berhasil Di Tambahkan'); 
        } catch (\Throwable $th) {
            return redirect()->route('event.index')->with('eror', 'Data Acara Gagal Di Tambahkan'); 
        }
    } 
    
    public function detail($id)
    {

    $acara = Acara::find($id);

    if ($acara) {
        $acara->participantCount = Partisipan::where('acara_id', $acara->id)->count();
        $partisipan = Partisipan::where('acara_id', $id)->get();

        $detailTempat = DetailTempat::whereHas('acara', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $namaRuang = [];

        if ($detailTempat->isNotEmpty()) {
            foreach ($detailTempat as $detail) {
                $namaRuang[] = $detail->ruang->nama;
            }
        }

        $namaRuangString = implode(', ', $namaRuang);

        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "acara"],
        ];

        return view('home.event.detail', compact('acara', 'partisipan', 'pageConfigs', 'breadcrumbs', 'namaRuangString'));
    } else {
        return redirect()->route('home')->with('error', 'Acara tidak ditemukan.');
    }
    }
    
    public function myevent()
    {

    $userId = auth()->user()->id;
    $user = User::all();
    $ruang = Ruang::all();

    $acara = Acara::where('koordinator', $userId)->get();

    foreach ($acara as $data) {
        $data->userParticipating = Partisipan::where('user_id', $userId)
                                             ->where('acara_id', $data->id)
                                             ->exists();

        $data->participantCount = Partisipan::where('acara_id', $data->id)->count();
    }

    $pageConfigs = ['layoutWidth' => 'full'];
    $breadcrumbs = [
        ['link' => "home", 'name' => "Home"], ['name' => "Events"], ['name' => "My Events"]
    ];

    return view('home.event.myevent', compact('acara', 'user', 'ruang', 'pageConfigs', 'breadcrumbs'));
    }

    public function mydetail($id)
    {

    $acara = Acara::find($id);
    $usersa = User::all();
    if ($acara) {
        $acara->participantCount = Partisipan::where('acara_id', $acara->id)->count();
        $partisipan = Partisipan::where('acara_id', $id)->get();

        $detailTempat = DetailTempat::whereHas('acara', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $namaRuang = [];

        if ($detailTempat->isNotEmpty()) {
            foreach ($detailTempat as $detail) {
                $namaRuang[] = $detail->ruang->nama;
            }
        }

        $namaRuangString = implode(', ', $namaRuang);

        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "acara"],
        ];

        return view('home.event.myeventdetail', compact('acara', 'usersa', 'partisipan', 'pageConfigs', 'breadcrumbs', 'namaRuangString'));
    } else {
        return redirect()->route('home')->with('error', 'Acara tidak ditemukan.');
    }
    }
    
    public function tambahparti($id)
    {

    $acara = Acara::find($id);
    $usersa = User::all();
    if ($acara) {
        $acara->participantCount = Partisipan::where('acara_id', $acara->id)->count();
        $partisipan = Partisipan::where('acara_id', $id)->get();

        $detailTempat = DetailTempat::whereHas('acara', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $namaRuang = [];

        if ($detailTempat->isNotEmpty()) {
            foreach ($detailTempat as $detail) {
                $namaRuang[] = $detail->ruang->nama;
            }
        }

        $namaRuangString = implode(', ', $namaRuang);

        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['name' => "acara"],
        ];

        return view('home.event.tambahpar', compact('acara', 'usersa', 'partisipan', 'pageConfigs', 'breadcrumbs', 'namaRuangString'));
    } else {
        return redirect()->route('home')->with('error', 'Acara tidak ditemukan.');
    }
    }
    


}

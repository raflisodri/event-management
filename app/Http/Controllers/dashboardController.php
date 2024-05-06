<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\UnitBisnis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(Request $request)
    {   
            $topKoordinators = Acara::select('koordinator', Acara::raw('COUNT(*) as acara_count'))
            ->groupBy('koordinator')
            ->orderByDesc('acara_count')
            ->take(4)
            ->get();

        $koordinators = User::whereIn('id', $topKoordinators->pluck('koordinator'))->get();

        foreach ($koordinators as $koordinator) {
        $koordinator->acara_count = $topKoordinators->where('koordinator', $koordinator->id)->first()->acara_count;
        }

        $tahun = Carbon::now()->year;

        $acaraPerBulanMinggu = DB::table('acaras')
            ->select(
                DB::raw('MONTH(tgl_acara) as bulan'), 
                DB::raw('WEEK(tgl_acara, 0) as minggu'), 
                DB::raw('COUNT(*) as jumlah_acara')
            )
            ->whereYear('tgl_acara', $tahun)
            ->groupBy(['bulan', 'minggu'])
            ->orderBy('bulan', 'asc')
            ->orderBy('minggu', 'asc')
            ->get();
    
            $bulan = $request->input('bulan', Carbon::now()->month);
            $tahun = Carbon::now()->year;
        
            // Menghitung acara per minggu untuk bulan yang dipilih
            $acaraPerMinggu = DB::table('acaras')
                ->select(DB::raw('WEEK(tgl_acara, 0) as minggu'), DB::raw('COUNT(*) as jumlah_acara'))
                ->whereMonth('tgl_acara', $bulan)
                ->whereYear('tgl_acara', $tahun)
                ->groupBy('minggu')
                ->orderBy('minggu', 'asc')
                ->get();
        

        // Menemukan bulan dan minggu dengan jumlah acara terbanyak
        $acaraTerbanyak = $acaraPerBulanMinggu->sortByDesc('jumlah_acara')->first();

        
        $acara = Acara::orderBy('tgl_acara', 'desc')->take(4)->get();
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "Index"]
        ];
        return view('content.home', ['acara'=> $acara, 'koordinators' => $koordinators, 'breadcrumbs' => $breadcrumbs,  'acaraPerBulanMinggu' => $acaraPerBulanMinggu,
        'acaraTerbanyak' => $acaraTerbanyak,  'acaraPerMinggu' => $acaraPerMinggu, 'bulanDipilih' => $bulan,]);
    }
}

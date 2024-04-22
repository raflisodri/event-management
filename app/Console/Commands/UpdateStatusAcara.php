<?php

namespace App\Console\Commands;

use App\Models\Acara;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStatusAcara extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $acaras = Acara::where('status', 'event opened')->get();

    foreach ($acaras as $acara) {
        $tglAcara = Carbon::parse($acara->tgl_acara);
        $wkAkhir = Carbon::parse($acara->wk_akhir);
        $today = Carbon::today();

        $tglAkhir = $tglAcara->copy()->addDays($wkAkhir->diffInDaysFiltered(fn(Carbon $date) => !$date->isWeekend(), $tglAcara));

        if ($tglAkhir->lessThanOrEqualTo($today)) {
            $acara->update(['status' => 'event closed']);
        }
        dd($acaras);
    }

    }
}

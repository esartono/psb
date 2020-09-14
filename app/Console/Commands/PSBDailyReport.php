<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TahunPelajaran;
use App\Gelombang;
use Telegram;


class PSBDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laporan Pendaftar Aktif PSB Harian setiap Jam 7.00 dan 17.00';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya.catnya')->where('tp', $tp->id)
                ->orderBy('unit_id', 'asc')->get()->toArray();

        $cek = 'Update Pendaftaran PPDB SIT NF'.PHP_EOL.'Tanggal: '.date('d M Y').' ('.date('H:i').')'.PHP_EOL;
        // foreach ($gelombang as $gel) {
        //     $cek = $cek.PHP_EOL.$gel['unitnya']['catnya']['name'] . ' : ' . ($gel['jlhrekap']['laktif']+$gel['jlhrekap']['paktif']);
        // }
        foreach ($gelombang as $gel) {
            $cek = $cek.PHP_EOL.$gel['unitnya']['name'] . ' : '.PHP_EOL.
                '  Umum : '.$gel['jlhrekap']['umumaktif'].PHP_EOL.
                '  Internal : '.$gel['jlhrekap']['nfaktif'].PHP_EOL.
                '  Pegawai : '.$gel['jlhrekap']['pegaktif'].PHP_EOL.
                '  TOTAL : '.($gel['jlhrekap']['umumaktif']+$gel['jlhrekap']['nfaktif']+$gel['jlhrekap']['pegaktif']).PHP_EOL;
        }

        Telegram::sendMessage(
            [
                'chat_id' => '643982879',
                'text' => $cek
            ],
            [
                'chat_id' => '11095399',
                'text' => $cek
            ],
            [
                'chat_id' => '330501661',
                'text' => $cek
            ]
        );
    }
}

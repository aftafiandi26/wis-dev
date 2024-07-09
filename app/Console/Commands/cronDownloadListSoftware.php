<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Maatwebsite\Excel\Facades\Excel;
use App\AssetSoftware;


class cronDownloadListSoftware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloader:cronSoftware';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'download list software everyday';

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
        $getData = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+1 days")))->latest()->first();        
        if(!empty($getData)){
            $datapertama = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+1 days")))->where('expiring_date', '>=', date('Y-m-d'))->get();

           Excel::create('List Software', function($excel) {
                $excel->sheet('End Soon', function($sheet) {
                      $sheet->setOrientation('landscape');
                      $sheet->setAutoSize(true);
                      $sheet->loadView('IT.Asset.software.generateDataSoftware');
                });
            })->export('xls');  
        }
    }
}

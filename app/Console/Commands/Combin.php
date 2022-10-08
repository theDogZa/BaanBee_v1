<?php

namespace App\Console\Commands;

use DB;
use Storage;
use Illuminate\Console\Command;

class Combin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $zCostcenters = DB::table('z_costcenter')->Where('id', 6)->orderBy('id')->get();
        $z_accounts = DB::table('z_account')->orderBy('id')->get();
        $z_productcategorys = DB::table('z_productcategory')->orderBy('id')->get();
        $z_customers = DB::table('z_customer')->orderBy('id')->get();
        $loop = 1;

        foreach ($zCostcenters as $ZCC) {
            $commbinTXT = "";
            foreach ($z_accounts as $ZACC) {
                foreach ($z_productcategorys as $ZPC) {
                    foreach ($z_customers as $ZCUS) {
                        if ($loop > 0) {
                            echo $commbin = $ZCC->code . "." . $ZACC->code . "." . $ZPC->code . "." . $ZCUS->code;
							//$commbinTXT .= $commbin."/n";

							//DB::insert('insert into z_combination (code_combination) values ("'.$commbin.'" )');

                            $loop++;
                        } else {
                            break;
                        }
                    }
                }
            }
			//Storage::put($ZCC->code . '.txt', $commbinTXT);
        }
    }
}
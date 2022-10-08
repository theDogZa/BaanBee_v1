<?php
namespace App\Console\Commands;

use DB;
use Storage;
use Illuminate\Console\Command;

class Combin extends Command {
	$zCostcenters = DB::table('z_costcenter')->Where('id',5)->orderBy('id')->get();
	$z_accounts = DB::table('z_account')->orderBy('id')->get();
	$z_productcategorys = DB::table('z_productcategory')->orderBy('id')->get();
	$z_customers = DB::table('z_customer')->orderBy('id')->get();
	$loop = 1;
		
		foreach($zCostcenters AS $ZCC){
			$commbinTXT = "";
			foreach ($z_accounts as $ZACC) {
				foreach ($z_productcategorys as $ZPC) {
					foreach ($z_customers as $ZCUS) {
						if($loop>0){
							echo $commbin =  $ZCC->code.".". $ZACC->code.".". $ZPC->code . "." . $ZCUS->code;
							$loop++;
						}else{
							break;
						}
					}
				}
			}
		}
			//Storage::put($ZCC->code . '.txt', $commbinTXT);
}
?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Warehouse extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Warehouses';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    public $sortable = [ 'id','warehouse_name','warehouse_code','warehouse_address','province_id','warehouse_tel1','warehouse_tel2','warehouse_desc','active', 'created_uid', 'updated_uid'];


    public function province()
    {
        return $this->belongsTo(Province::class);
    }


    
}


/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 23:55
 * Version : ver.1.00.00
 *
 * File Create : 2018-05-15 22:39:53 *
 */
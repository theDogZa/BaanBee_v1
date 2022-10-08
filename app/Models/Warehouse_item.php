<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Warehouse_item extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Warehouse_items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    public $sortable = [ 'id','warehouse_id','item_id','qty','min_qty','max_qty','warehouse_item_desc','active', 'created_uid', 'updated_uid'];


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }


    public function item()
    {
        return $this->belongsTo(Item::class);
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
 * File Create : 2018-05-15 22:59:05 *
 */
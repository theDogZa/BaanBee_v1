<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Item_adjusted extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Item_adjusteds';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    public $sortable = [ 'id','date','doc_num','adjusted_status','adjusted_desc','active', 'created_uid', 'updated_uid'];


    
}


/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 23:55
 * Version : ver.1.00.00
 *
 * File Create : 2018-07-25 00:17:45 *
 */
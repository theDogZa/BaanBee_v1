<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Item extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    public $sortable = [ 'id','item_categorie_id','item_size_id','item_color_id','item_unit_id','item_name','item_code','item_num','item_sale_price','item_cost_price','item_qty','item_qty_min','item_qty_max','item_sale_qty','item_desc','active', 'created_uid', 'updated_uid'];


    public function item_category()
    {
        return $this->belongsTo(Item_category::class);
    }


    public function item_size()
    {
        return $this->belongsTo(Item_size::class);
    }


    public function item_color()
    {
        return $this->belongsTo(Item_color::class);
    }


    public function item_unit()
    {
        return $this->belongsTo(Item_unit::class);
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
 * File Create : 2018-04-28 22:12:49 *
 */
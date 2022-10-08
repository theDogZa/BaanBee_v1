<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Auth_menu extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Auth_menus';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */


    protected $fillable = ['groups', 'parent_id', 'menu_name', 'menu_link', 'menu_icon', 'menu_sort', 'active', 'created_uid', 'updated_uid'];
    public $sortable = [ 'id','groups','parent_id','menu_name','menu_link','menu_icon','menu_sort','active', 'created_uid', 'updated_uid'];


    public function user()
    {
        return $this->belongsTo(User::class);
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
 * File Create : 2018-04-17 22:48:07 *
 */
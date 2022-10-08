<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kyslik\ColumnSortable\Sortable;

class Example extends Model implements Transformable
{
    use TransformableTrait;
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Examples';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    protected $fillable = [ 'parent_id','users_id','title','body','amount','date','time','datetime','status','active' ];
    public $sortable = [ 'id','parent_id','users_id','title','body','amount','date','time','datetime','status','active' ];


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
 * File Create : 2018-04-14 01:57:15 *
 */
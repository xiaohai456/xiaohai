<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yuan extends Model
{
    protected $table='yuan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}

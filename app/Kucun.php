<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kucun extends Model
{
    protected $table='kucun';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = "tintuc";
    public function loaitin(){
        return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }
    public function comment(){
        return $this->hasMany('App\Comment','idTinTuc','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ujian extends Model
{
    //
  protected $table = 'ujian';
    // protected $connection = 'connection1';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';
    // public $timestamps =  false;
  protected $fillable = [
      'nama_mk', 'dosen', 'jumlah_soal', 'keterangan', 'created_at', 'updated_at'
  ];
  function getAll(){
    return  DB::table('ujian')->get();
  }
}

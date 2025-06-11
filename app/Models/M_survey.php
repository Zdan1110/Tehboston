<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class M_survey extends Model
{
    public function survey()
    {
        return DB::table('tb_survey ')->get();
    }

    public function datacalon()
    {
        return DB::table('tb_calonmitra')->get();
    }

    public static function allData()
    {
        return DB::table('tb_survey')->get();
    }

    public static function dataAkun()
    {
       return DB::table('tb_calonmitra')->get();
    }

    public static function dataProduk()
    {
        return self::whereNotNull('total_luas')->get();
    }
}

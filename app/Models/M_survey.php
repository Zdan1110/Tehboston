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

    public function buatlaporan($id_calon)
    {
        return DB::table('tb_calonmitra')->where('id_calon', $id_calon)->first();
    }

    public static function allData()
    {
        return DB::table('tb_survey')->get();
    }

    public static function dataAkun()
    {
       return DB::table('tb_calonmitra')->where('status', 'Proses')->get();
    }
}

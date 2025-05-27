<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_kasir extends Model
{
    protected $table = 'tb_penjualan';
    protected $fillable = ['id_penjualan','pelanggan', 'harga', 'tanggal'];

    public function allData()
    {
        return DB::table('tb_produk')->get();
    }
}

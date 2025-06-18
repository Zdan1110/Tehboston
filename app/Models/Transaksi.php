<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';

    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    
    public $timestamps = false; 

    /**
     * 
     *
     * @var array<int
     */
    protected $fillable = [
        'id_transaksi',
        'transaksi',
        'pemasukan',
        'pengeluaran',
        'supplier',
        'keterangan',
    ];
}
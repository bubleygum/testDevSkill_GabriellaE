<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableB extends Model
{
    protected $table = 'table_b';
    public $timestamps = false;
    protected $primaryKey = 'kode_toko';
    public $incrementing = false;
    protected $fillable = [
        'kode_toko',   
        'nominal_transaksi',   
    ];
}

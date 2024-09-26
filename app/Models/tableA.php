<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableA extends Model
{
    protected $table = 'table_a';
    public $timestamps = false;
    protected $primaryKey = 'kode_toko_baru';
    public $incrementing = false;
    protected $fillable = [
        'kode_toko_baru',   
        'kode_toko_lama',   
    ];
}

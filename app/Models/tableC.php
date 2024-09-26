<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableC extends Model
{
    protected $table = 'table_c';
    public $timestamps = false;
    protected $primaryKey = 'kode_toko';
    public $incrementing = false;
    protected $fillable = [
        'kode_toko',   
        'area_sales',   
    ];
}

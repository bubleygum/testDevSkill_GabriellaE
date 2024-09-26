<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableD extends Model
{
    protected $table = 'table_d';
    public $timestamps = false;
    protected $primaryKey = 'kode_sales';
    public $incrementing = false;
    protected $fillable = [
        'kode_sales',   
        'nama_sales',   
    ];
}

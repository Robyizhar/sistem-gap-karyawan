<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaryawanPKWT extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'karyawan_pkwt';

    protected $fillable = [
        'np',
        'nama',
        'unit_id',
        'kode_bagan_id',
        'status',
        'kontrak',
        'keterangan'
    ];
}

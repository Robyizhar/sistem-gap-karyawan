<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'np',
        'nama_lengkap',
        'tempat_lahir' ,
        'tanggal_lahir' ,
        'tanggal_masuk' ,
        'tanggal_pensiun' ,
        'tanggal_mpp' ,
        'status_pensiun' ,
        'kode_unit_kerja' ,
        'unit_kerja_id' ,
        'jabatan_id',
        'level_id',
        'grade_jabatan_id',
        'pangkat_id',
        'grade_pangkat',
        'tmt_jabatan',
        'masa_jabatan'
    ];
}

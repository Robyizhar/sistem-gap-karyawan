<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    use HasFactory;

    protected $table="promosi_karyawan";

    protected $fillable = [
        'penilaian_karyawan_id',
        'unit_id',
        'jabatan_id',
        'new_jabatan_id',
        'level_id',
        'new_level_id',
        'pangkat_id',
        'new_pangkat_id',
        'tmt_sebelumnya'
    ];
}

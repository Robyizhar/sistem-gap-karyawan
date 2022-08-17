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

    public function unit() {
        return $this->hasOne(Unit::class, 'id', 'unit_kerja_id');
    }

    public function jabatan() {
        return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    }

    public function level() {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function pangkat() {
        return $this->hasOne(Pangkat::class, 'id', 'pangkat_id');
    }
}

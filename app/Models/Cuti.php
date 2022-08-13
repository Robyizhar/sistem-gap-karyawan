<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $table = 'cuti';
    protected $fillable = ['id_karyawan', 'file', 'jenis_cuti', 'jumlah_cuti', 'created_at', 'updated_at'];

    public function karyawans() {
        return $this->hasOne(Master\Karyawan::class, 'id', 'id_karyawan');
    }

}

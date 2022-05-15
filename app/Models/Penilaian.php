<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table="penilaian_karyawan";

    protected $fillable = [
        'id_karyawan',
        'id_unit_kerja',
        'sertifikasi_lsp',
        'no',
        'file_sertifikasi',
        'nilai_kedisiplinan',
        'keterangan_hukuman',
        'keyword',
        'nilai_kepatuhan',
        'nilai_sikap_kerja',
        'nilai_inisiatif',
        'status_promosi',
        'persentase',
    ];

}

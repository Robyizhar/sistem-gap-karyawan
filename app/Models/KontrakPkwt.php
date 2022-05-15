<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakPkwt extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_pkwt_id', 'no_sp', 'tanggal_sp', 'tanggal_mulai', 'tanggal_berakhir', 'tanggal_addendum', 'kontrak_ke'];
}

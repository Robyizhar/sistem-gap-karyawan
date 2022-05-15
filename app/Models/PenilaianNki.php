<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianNki extends Model {

    use HasFactory;
    protected $fillable = ['index_penilaian', 'karyawan_id', 'status', 'status_kontrak'];

}

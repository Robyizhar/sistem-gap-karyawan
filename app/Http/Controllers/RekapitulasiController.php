<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Unit;
use App\Models\Master\Pangkat;
use App\Models\Master\Karyawan;
use App\Repositories\BaseRepository;

class RekapitulasiController extends Controller {

    protected $unit, $pangkat;

    public function __construct(Unit $Unit, Pangkat $Pangkat) {
        $this->unit = new BaseRepository($Unit);
        $this->pangkat = new BaseRepository($Pangkat);
    }

    public function jabatan() {
        $units = $this->unit->query()->get();
        return view('rekapitulasi.jabatan', compact('units'));
    }

    public function level() {
        //
    }

    public function pangkat() {
        $units = $this->unit->query()->get();
        $pangkat_labels = Pangkat::pluck('nama')->toArray();
        $pangkats = $this->pangkat->query()->get();
        $counts = [];
        foreach ($pangkats as $pangkat) {
            $count = Karyawan::where('pangkat_id', $pangkat->id)->count();
            $counts [] = $count;
        }
        return view('rekapitulasi.pangkat', compact('units', 'pangkat_labels', 'counts'));
    }

    public function countPangkatByUnit(Request $request) {
        try {
            $pangkat_labels = Pangkat::pluck('nama')->toArray();
            $pangkats = $this->pangkat->query()->get();
            $counts = [];
            foreach ($pangkats as $pangkat) {
                $count = Karyawan::where('pangkat_id', $pangkat->id)->where('unit_kerja_id', $request->unit_id)->count();
                $counts [] = $count;
            }

            return response()->json([
                'pangkat_labels' => $pangkat_labels,
                'counts' => $counts,
                'status' => 'true'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th,
                'status' => 'false'
            ]);
        }
    }

}

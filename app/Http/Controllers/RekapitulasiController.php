<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Unit;
use App\Models\Master\Level;
use App\Models\Master\Pangkat;
use App\Models\Master\Karyawan;
use App\Models\Master\KaryawanPKWT;
use App\Repositories\BaseRepository;
use DB;
class RekapitulasiController extends Controller {

    protected $unit, $pangkat, $level;

    public function __construct(Unit $Unit, Pangkat $Pangkat, Level $Level) {
        $this->unit = new BaseRepository($Unit);
        $this->pangkat = new BaseRepository($Pangkat);
        $this->level = new BaseRepository($Level);
    }

    public function level() {
        $units = $this->unit->query()->get();
        $level_labels = Level::pluck('nama')->toArray();
        $levels = $this->level->query()->get();
        $counts = [];
        foreach ($levels as $level) {
            $count = Karyawan::where('level_id', $level->id)->count();
            $counts [] = $count;
        }
        return view('rekapitulasi.level', compact('units', 'level_labels', 'counts'));
    }

    public function countLevelByUnit(Request $request) {
        try {
            $level_labels = Level::pluck('nama')->toArray();
            $levels = $this->level->query()->get();
            $counts = [];
            foreach ($levels as $level) {
                $count = Karyawan::where('level_id', $level->id)->where('unit_kerja_id', $request->unit_id)->count();
                $counts [] = $count;
            }

            return response()->json([
                'level_labels' => $level_labels,
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

    public function pkwt() {
        $pkwt_labels = ['ORGANIK', 'PKWT'];
        $organiks = Karyawan::count();
        $pkwts = KaryawanPKWT::count();
        $counts = [
            'ORGANIK' => $organiks,
            'PKWT' => $pkwts
        ];
        // return $counts;
        $units = $this->unit->query()->get();
        return view('rekapitulasi.pkwt', compact('units', 'counts', 'pkwt_labels'));
    }

    public function countPkwtByUnit(Request $request) {
        try {
            $pkwt_labels = ['ORGANIK', 'PKWT'];
            $organiks = Karyawan::where('unit_kerja_id', $request->unit_id)->count();
            $pkwts = KaryawanPKWT::where('unit_id', $request->unit_id)->count();
            $counts = [
                'ORGANIK' => $organiks,
                'PKWT' => $pkwts
            ];
            return response()->json([
                'pkwt_labels' => $pkwt_labels,
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


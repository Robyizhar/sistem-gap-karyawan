<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penilaian;
use App\Models\Promosi;
use App\Models\Master\Unit;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServicePromosi;
use App\Service\ServiceKaryawan;
use App\Http\Requests\PromosiRequest;
use App\Models\Master\Karyawan;

class PromosiController extends Controller {

    protected $model, $penilaian, $service, $karyawan;

    public function __construct(Promosi $Promosi, Unit $unit, Karyawan $karyawan, Penilaian $penilaian) {
        $this->model = new BaseRepository($Promosi);
        $this->unit = new BaseRepository($unit);
        $this->karyawan = new BaseRepository($karyawan);
        $this->penilaian = new BaseRepository($penilaian);
        $this->service = new ServicePromosi;

    }

    public function index() {
        // return $this->service->getData()->get();
        $data['unit'] = $this->unit->get();
        return view('penilaian-promosi.promosi.index', compact('data'));
    }

    public function getData() {
        $data = $this->service->getData()->orderBy('promosi_karyawan.id', 'DESC')->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'detail_promosi' => $data,
                    'menu' => 'Promosi'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function store(PromosiRequest $request) {

        $data = $request->except(['_token', '_method', 'id', 'unit_kerja_id', 'tmt_sebelumnya']);

        $data_karyawan = [
            'jabatan_id' => $request->new_jabatan_id,
            'level_id' => $request->new_level_id,
            'pangkat_id' => $request->new_pangkat_id,
            'tmt_jabatan' => date("Y-m-d")
        ];

        $status = [
            'status_promosi' => true
        ];

        $penilaian = $this->penilaian->update($request->penilaian_karyawan_id, $status);
        $data['unit_id'] = $request->unit_kerja_id;
        $data['tmt_sebelumnya'] = $request->tmt_sebelumnya;
        $promosi = $this->model->store($data);

        if ($promosi && $penilaian) {

            $update_karyawan = $this->karyawan->update($request->id_karyawan, $data_karyawan);
            return response()->json($promosi, 200);

        }

    }

    public function cancelValid(Request $request) {

        $data = $request->except(['_token', '_method', 'id', 'unit_kerja_id']);

        $status = [
            'status_promosi' => false
        ];

        $penilaian = $this->penilaian->update($request->penilaian_karyawan_id, $status);

        $promosi = $this->model->find($request->id)->first();

        if ($promosi && $penilaian) {

            $delete_promosi = $this->model->softDelete($request->id);

            $data_karyawan = [
                'jabatan_id' => $promosi->jabatan_id,
                'level_id' => $promosi->level_id,
                'pangkat_id' => $promosi->pangkat_id,
                'tmt_jabatan' => $promosi->tmt_sebelumnya
            ];
            $update_karyawan = $this->karyawan->update($request->id_karyawan, $data_karyawan);
            return response()->json($promosi, 200);
        } else {

            $status = [
                'status_promosi' => true
            ];

            $penilaian = $this->penilaian->update($request->penilaian_karyawan_id, $status);

        }

    }

}

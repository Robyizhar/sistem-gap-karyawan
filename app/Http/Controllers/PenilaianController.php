<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Master\Unit;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use App\Service\ServicePenilaian;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServiceKaryawan;
use Carbon\Carbon;

class PenilaianController extends Controller {

    protected $model, $role, $service, $unit, $karyawans;

    public function __construct(Penilaian $Penilaian, Unit $unit) {
        $this->model = new BaseRepository($Penilaian);
        $this->unit = new BaseRepository($unit);
        $this->service = new ServicePenilaian;

    }

    public function index() {
        // $time_now = Carbon::now();
        // $now = $time_now->toDateString();
        // $one = date('Y-m-d',strtotime('-3 years'));
        // echo $now; //date('Y-m-d')
        // echo "<br>";
        // echo $one;
        return view('penilaian-promosi.penilaian.index');
    }

    public function getData() {
        $data = $this->service->getData()->orderBy('karyawans.np', 'ASC')->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'url_edit' => route('penilaian.edit', $data->id),
                    'url_show' => route('penilaian.show', $data->id),
                    'url_destroy' => route('penilaian.destroy', $data->id),
                    'menu' => 'Penilaian'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function create() {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawan;
        $karyawans = $services->getData($this->role, null, null, [], true)->orderBy('karyawans.np', 'ASC')->get();
        $param = [];
        $param['unit_kerja_id'] = $this->role;
        $params = (object) $param;
        $sertifikasi_lsp = $services->getLevel($params)->get();
        return view('penilaian-promosi.penilaian.create', compact('karyawans', 'sertifikasi_lsp'));
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['persentase'] = ($request->nilai_kepatuhan + $request->nilai_sikap_kerja + $request->nilai_inisiatif + $request->nilai_kedisiplinan) / 4;
            $this->model->store($data, true, ['file_sertifikasi'], 'file_sertifikasi_lsp');
            Alert::toast('Data Penilaian Berhasil Disimpan', 'success');
            return redirect()->route('penilaian.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function show($id) {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawan;
        $karyawans = $services->getData($this->role, null, null, [], true)->orderBy('karyawans.np', 'ASC')->get();
        $param = [];
        $param['unit_kerja_id'] = $this->role;
        $params = (object) $param;
        $sertifikasi_lsp = $services->getLevel($params)->get();
        $data['detail'] = $this->service->getData($id)->first();
        return view('penilaian-promosi.penilaian.detail', compact('karyawans', 'sertifikasi_lsp', 'data'));
    }

    public function edit($id) {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawan;
        $karyawans = $services->getData($this->role, null, null, [], true)->orderBy('karyawans.np', 'ASC')->get();
        $param = [];
        $param['unit_kerja_id'] = $this->role;
        $params = (object) $param;
        $sertifikasi_lsp = $services->getLevel($params)->get();
        $data['detail'] = $this->service->getData($id)->first();
        return view('penilaian-promosi.penilaian.create', compact('karyawans', 'sertifikasi_lsp', 'data'));
    }

    public function update(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['persentase'] = ($request->nilai_kepatuhan + $request->nilai_sikap_kerja + $request->nilai_inisiatif + $request->nilai_kedisiplinan) / 4;
            if (request()->file('file_sertifikasi') != '') {
                $this->model->update($request->id, $data, true, ['file_sertifikasi'], 'file_sertifikasi_lsp');
            } else {
                $this->model->update($request->id, $data, false);
            }
            Alert::toast('Data Penilaian Berhasil Dirubah', 'success');
            return redirect()->route('penilaian.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function destroy($id) {
        try {
            $data = $this->model->softDelete($id);
            Alert::toast($data->nama.' Berhasil Dihapus', 'success');
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('jabatan.index');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianNki;
use App\Models\Master\Unit;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use App\Service\ServicePenilaian;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServiceKaryawanPkwt;
use App\Models\Master\KaryawanPKWT;
use DB;

class PenilaianNKIController extends Controller {

    protected $model, $role, $service, $unit, $karyawans;

    public function __construct(PenilaianNki $Penilaian, Unit $unit) {
        $this->model = new BaseRepository($Penilaian);
        $this->unit = new BaseRepository($unit);
        $this->service = new ServicePenilaian;

    }

    public function index() {
        return view('penilaian-promosi.penilaian-nki.index');
    }

    public function getData() {
        $this->role = auth()->user()->unit_id;
        $data = $this->service->getDataNKI(null, $this->role)->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'url_edit' => route('penilaian-nki.edit', $data->id),
                    'url_show' => route('penilaian-nki.show', $data->id),
                    'url_destroy' => route('penilaian-nki.destroy', $data->id),
                    'menu' => 'Penilaian NKI'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function create() {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawanPkwt;
        $karyawans = $services->getData($this->role)->get();
        $index_penilaian = DB::table('index_penilaians')->get();
        return view('penilaian-promosi.penilaian-nki.create', compact('karyawans', 'index_penilaian'));
    }

    public function createNew($id){
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawanPkwt;
        $karyawans = $services->getData($this->role)->get();
        $index_penilaian = DB::table('index_penilaians')->get();
        $data = KaryawanPKWT::findOrFail($id);
        return view('penilaian-promosi.penilaian-nki.add-new', compact('data', 'karyawans', 'index_penilaian'));
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id', 'penilaian']);
            $data['index_penilaian'] = json_encode($request->penilaian);
            $data['status_kontrak'] = false;
            $data['status'] = 0;
            $this->model->store($data);
            Alert::toast('Data Penilaian Berhasil Disimpan', 'success');
            return redirect()->route('penilaian-nki.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function show($id) {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawanPkwt;
        $karyawans = $services->getData($this->role)->get();
        $index_penilaian = DB::table('index_penilaians')->get();
        $data = $this->service->getDataNKI($id)->first();
        $index_penilaians = json_decode($data->index_penilaian);
        return view('penilaian-promosi.penilaian-nki.detail', compact('karyawans', 'index_penilaian', 'index_penilaians', 'data'));
    }

    public function edit($id) {
        $this->role = auth()->user()->unit_id;
        $services = new ServiceKaryawanPkwt;
        $karyawans = $services->getData($this->role)->get();
        $index_penilaian = DB::table('index_penilaians')->get();
        $data = $this->service->getDataNKI($id)->first();
        $edit = true;
        $index_penilaians = json_decode($data->index_penilaian);
        return view('penilaian-promosi.penilaian-nki.create', compact('karyawans', 'index_penilaian', 'index_penilaians', 'data', 'edit'));
    }

    public function update(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id', 'penilaian']);
            $data['index_penilaian'] = json_encode($request->penilaian);
            $data['status_kontrak'] = false;
            $data['status'] = 0;
            $this->model->update($request->id, $data, false);
            Alert::toast('Data Penilaian Berhasil Dirubah', 'success');
            return redirect()->route('penilaian-nki.index');
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

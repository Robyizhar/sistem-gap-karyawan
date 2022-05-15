<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\KaryawanPKWT;
// use App\Models\Master\Jabatan;
use App\Models\Master\Unit;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
// use App\Http\Requests\Master\KaryawanRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Service\ServiceKaryawanPkwt;
use Carbon;

class KaryawanPkwtController extends Controller
{

    protected $model, $role, $service, $unit;

    public function __construct(KaryawanPKWT $Karyawan, Unit $unit) {
        $this->model = new BaseRepository($Karyawan);
        $this->unit = new BaseRepository($unit);
        $this->service = new ServiceKaryawanPkwt;
    }

    public function index() {
        return view('master.karyawan-pkwt.index');
    }

    public function getData() {
        $this->role = auth()->user()->unit_id;
        $data = $this->service->getData($this->role)->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    // 'url_show' => route('karyawan-pkwt.show', $data->id),
                    'url_edit' => route('karyawan-pkwt.edit', $data->id),
                    'url_destroy' => route('karyawan-pkwt.destroy', $data->id),
                    'menu' => 'Karyawan PKWT'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function create() {
        $data['unit'] = $this->unit->get();
        return view('master.karyawan-pkwt.create', compact('data'));
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['kontrak'] = 1;
            $data['kode_bagan_id'] = '32000';
            $data['status'] = '32000';
            $data['nama'] = strtoupper($request->nama);

            $this->model->store($data);
            Alert::toast('Data Karyawan PKWT Berhasil Disimpan', 'success');
            return redirect()->route('karyawan-pkwt.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    // public function show($id) {
    //     //
    // }

    public function edit($id) {
        try {
            $data['unit'] = $this->unit->get();
            $data['detail'] = $this->model->find($id);
            return view('master.karyawan-pkwt.create', compact('data'));
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('karyawan-pkwt.index');
        }
    }

    public function update(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['nama'] = strtoupper($request->nama);

            $this->model->update($request->id, $data);
            Alert::toast('Karyawan '.$data['nama'].' Berhasil Dirubah', 'success');
            return redirect()->route('karyawan-pkwt.index');
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
            return redirect()->route('karyawan-pkwt.index');
        }
    }
}

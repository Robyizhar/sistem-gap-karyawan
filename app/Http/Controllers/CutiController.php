<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServiceKaryawan;
use App\Models\Master\KaryawanPKWT;
use DB;
use Carbon;

class CutiController extends Controller
{

    protected $model;

    public function __construct(Cuti $Cuti) {
        $this->model = new BaseRepository($Cuti);

    }

    public function index() {
        return view('penilaian-promosi.cuti.index');
    }

    public function getData() {
        $data = Cuti::with('karyawans')
            ->where('end_date', '>=', Carbon\Carbon::today())
            ->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'url_edit' => route('cuti.edit', $data->id),
                    'url_destroy' => route('cuti.destroy', $data->id),
                    'menu' => 'Cuti'
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
        $cuties = $this->jenisCuti();
        $karyawans = $services->getData($this->role, null, null, [], false)->orderBy('karyawans.np', 'ASC')->get();
        return view('penilaian-promosi.cuti.create', compact('karyawans', 'cuties'));
    }

    private function jenisCuti() {
        return [ 'Cuti Sakit', 'Cuti Besar', 'Cuti Hamil dan Melahirkan', 'Cuti Penting' ];
    }

    public function store(Request $request) {

        try {
            $data = $request->except(['_token', '_method', 'id']);
            $exist = Cuti::where('id_karyawan', $data['id_karyawan'])
                ->where('end_date', '>=', Carbon\Carbon::today())
                ->first();
            if (!empty($exist)) {
                Alert::toast('Karyawan ini sedang menjalani cuti', 'error');
                return redirect()->route('cuti.index');
            }
            $data['jumlah_cuti'] = '1';
            $this->model->store($data, true, ['file'], 'form_cuti');
            Alert::toast('Data Berhasil Disimpan', 'success');
            return redirect()->route('cuti.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id) {
        $this->role = auth()->user()->unit_id;
        $data['detail'] = Cuti::with('karyawans.jabatan', 'karyawans.level', 'karyawans.pangkat')->findOrFail($id);
        $cuties = $this->jenisCuti();
        // return $data['detail'];
        $services = new ServiceKaryawan;
        $karyawans = $services->getData($this->role, null, null, [], false)->orderBy('karyawans.np', 'ASC')->get();
        return view('penilaian-promosi.cuti.create', compact('karyawans', 'data', 'cuties'));
    }

    public function update(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            if (request()->file('file') != '') {
                $this->model->update($request->id, $data, true, ['file'], 'form_cuti');
            } else {
                $this->model->update($request->id, $data, false);
            }
            Alert::toast('Data Berhasil Dirubah', 'success');
            return redirect()->route('cuti.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function destroy($id) {
        try {
            $data = $this->model->softDelete($id);
            Alert::toast('Data Berhasil Dihapus', 'success');
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 200);
        }
    }
}

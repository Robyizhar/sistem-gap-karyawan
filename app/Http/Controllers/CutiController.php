<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\KontrakPkwt;
use App\Models\Cuti;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServiceKaryawan;
use App\Models\Master\KaryawanPKWT;
use DB;

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
        $data = Cuti::with('karyawans')->get();
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
        $karyawans = $services->getData($this->role, null, null, [], false)->orderBy('karyawans.np', 'ASC')->get();
        return view('penilaian-promosi.cuti.create', compact('karyawans'));
    }

    public function store(Request $request) {
        // return response()->json($data, 200);
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['jumlah_cuti'] = '1';
            $this->model->store($data, true, ['file'], 'form_cuti');
            Alert::toast('Data Citi  Berhasil Disimpan', 'success');
            return redirect()->route('cuti.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontrakPkwt;
use App\Models\PenilaianNki;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Service\ServicePromosi;
use App\Models\Master\KaryawanPKWT;
use DB;

class KontrakPkwtController extends Controller
{

    public function __construct(KontrakPkwt $KontrakPkwt, KaryawanPKWT $KaryawanPKWT, PenilaianNki $PenilaianNki) {
        $this->model = new BaseRepository($KontrakPkwt);
        $this->KaryawanPKWT = new BaseRepository($KaryawanPKWT);
        $this->PenilaianNki = new BaseRepository($PenilaianNki);
        $this->service = new ServicePromosi;

    }

    public function index() {
        return view('penilaian-promosi.kontrak.index');
    }

    public function getData() {
        $data = $this->service->getDataPkwt()->orderBy('penilaian_nkis.id', 'DESC')->get();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'detail_kontrak' => $data,
                    'menu' => 'Kontrak'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function store(Request $request) {

        $data = $request->except(['_token', '_method']);
        $data_penilaian_nki = [
            'status' => 1,
            'status_kontrak' => true
        ];
        $tanggal_mulai = date_format(date_create($data['tanggal_mulai']), 'Y-m-d');
        $tanggal_berakhir = date_format(date_create($data['tanggal_berakhir']), 'Y-m-d');
        DB::beginTransaction();
        $PenilaianNki = $this->PenilaianNki->update($data['id'], $data_penilaian_nki);
        $kontrak_pkwt = KontrakPkwt::where('karyawan_pkwt_id', $PenilaianNki->karyawan_id)->firstOrFail();
        $kontrak_pkwt->update([
            'tanggal_mulai' => date('Y-m-d', strtotime($tanggal_berakhir . ' + 1 days')),
            'tanggal_berakhir' =>  date('Y-m-d', strtotime($tanggal_berakhir . ' + 1 years')),
            'kontrak_ke' => $data['kontrak_ke'] + 1
        ]);
        if ($PenilaianNki && $kontrak_pkwt) {
            DB::commit();
            return response()->json($kontrak_pkwt, 200);
        } else {
            DB::rollback();
        }

    }

    public function cancelValid(Request $request) {

        $data = $request->except(['_token', '_method']);
        $data_penilaian_nki = [
            'status' => 0,
            'status_kontrak' => false
        ];
        $tanggal_mulai = date_format(date_create($data['tanggal_mulai']), 'Y-m-d');
        $tanggal_berakhir = date_format(date_create($data['tanggal_berakhir']), 'Y-m-d');
        DB::beginTransaction();
        $PenilaianNki = $this->PenilaianNki->update($data['id'], $data_penilaian_nki);
        $kontrak_pkwt = KontrakPkwt::where('karyawan_pkwt_id', $PenilaianNki->karyawan_id)->firstOrFail();
        $kontrak_pkwt->update([
            'tanggal_mulai' => date('Y-m-d', strtotime($tanggal_mulai . ' - 366 days')),
            'tanggal_berakhir' =>  date('Y-m-d', strtotime($tanggal_berakhir . ' - 365 days')),
            'kontrak_ke' => $data['kontrak_ke'] - 1
        ]);
        if ($PenilaianNki && $kontrak_pkwt) {
            DB::commit();
            return response()->json($kontrak_pkwt, 200);
        } else {
            DB::rollback();
        }

    }
}

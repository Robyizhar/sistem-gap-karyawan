<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Karyawan;
use App\Models\Master\Jabatan;
use App\Models\Master\Unit;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Master\KaryawanRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Service\ServiceKaryawan;
use Carbon;

class KaryawanController extends Controller
{
    // $user = auth()->user()->id;
    protected $model, $role, $service, $unit;

    public function __construct(Karyawan $Karyawan, Unit $unit) {
        $this->model = new BaseRepository($Karyawan);
        $this->unit = new BaseRepository($unit);
        $this->service = new ServiceKaryawan;

    }

    public function index() {
        // return view('master.karyawan.index');
        $this->role = auth()->user()->unit_id;
        $data = $this->service->getData($this->role)->orderBy('karyawans.np')->get();
        return response()->json($data, 200); 
    }

    public function getData() {
        $this->role = auth()->user()->unit_id;
        $data = $this->service->getData($this->role)->get();
        return DataTables::of($data)
        ->addColumn('Status_Pensiun', function($data) {
            $badges = '';

            if (strtotime($data->tanggal_pensiun) <= strtotime('+1 years') && strtotime($data->tanggal_pensiun) > strtotime('now')) {
                $tanggal_pensiun = date_create_from_format('Y-m-d', $data->tanggal_pensiun);
                $tanggal_sekarang = date_create_from_format('Y-m-d', date('Y-m-d'));
                $sisa_waktu_kerja = (array) date_diff($tanggal_pensiun, $tanggal_sekarang);
                $badges .= $sisa_waktu_kerja['m']. ' Bulan '. $sisa_waktu_kerja['d'] . ' Hari lagi';
            } else if (strtotime($data->tanggal_pensiun) == strtotime('now')) {
                $badges .= 'Pensiun Hari Ini';
            } else if (strtotime($data->tanggal_pensiun) < strtotime('now')) {
                $badges .= 'Sudah Pensiun';
            }

            return view('layouts.component.badge', ['status_pensiun' => $badges] );
        })
        ->addColumn('Status_Penilaian', function($data) {
            $badges = '';
            if(strtotime($data->tanggal_pensiun) > strtotime('now')) {
                if ($data->penilaian_karyawan_status_promosi == false && ($data->penilaian_karyawan_id != null || $data->penilaian_karyawan_id != '')) {
                    $badges .= 'Sudah dinilai';
                } else if (strtotime($data->tmt_jabatan . ' + 3 years') > strtotime('now')) {
                    $badges .= '';
                } else {
                    $badges .= 'Belum dinilai';
                }

                return view('layouts.component.badge', ['status_penilaian' => $badges] );
            } else {
                return $badges;
            }

        })
        ->addColumn('Lama_Jabatan', function($data) {
            $badges = '';

            $tmt_jabatan = date_create_from_format('Y-m-d', $data->tmt_jabatan);
            $tanggal_sekarang = date_create_from_format('Y-m-d', date('Y-m-d'));
            $interval = (array) date_diff($tmt_jabatan, $tanggal_sekarang);

            $year = '';
            $month = '';
            $day = 'Promosi Hari Ini';

            if($interval['y'] != 0 || $interval['y'] != '0')
                $year = $interval['y'] . ' Tahun ';

            if($interval['m'] != 0 || $interval['m'] != '0')
                $month = $interval['m'] . ' Bulan ';

            if($interval['d'] != 0 || $interval['d'] != '0')
                $day = $interval['d'] . ' Hari ';

            $badges .= $year.$month.$day;

            if(strtotime($data->tanggal_pensiun) > strtotime('now')) {
                return view('layouts.component.badge', ['lama_jabatan' => $badges] );
            } else {
                return $badges = '';
            }

        })
        ->addColumn('Action', function ($data) {
            return view('layouts.component.action', [
                    'model' => $data,
                    'url_show' => route('karyawan.show', $data->id),
                    'url_edit' => route('karyawan.edit', $data->id),
                    'url_destroy' => route('karyawan.destroy', $data->id),
                    'menu' => 'Karyawan'
                ]
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action', 'Status_Pensiun', 'Status_Penilaian', 'Lama_Jabatan'])
        ->make(true);
    }

    public function create() {
        $data['unit'] = $this->unit->get();
        return view('master.karyawan.create', compact('data'));
    }

    public function getJabatan(Request $request) {

        $jabatan = $this->service->getJabatan($request->unit_kerja_id)->get();

        return response()->json($jabatan, 200);

    }

    public function getPangkat(Request $request) {

        $pangkat = $this->service->getPangkat($request)->get();

        return response()->json($pangkat, 200);

    }

    public function getLevel(Request $request) {

        $pangkat = $this->service->getLevel($request)->get();

        return response()->json($pangkat, 200);

    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['tanggal_pensiun'] = date('Y-m-d', strtotime('+56 years', strtotime($data['tanggal_lahir'])));

            $this->model->store($data);
            Alert::toast('Data Karyawan Berhasil Disimpan', 'success');
            return redirect()->route('karyawan.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id) {
        try {
            $data['unit'] = $this->unit->get();
            $data['detail'] = $this->model->find($id);
            return view('master.karyawan.create', compact('data'));
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('karyawan.index');
        }
    }

    public function show($id) {
        try {
            $data['detail'] = $this->service->getData(null)->where('karyawans.id', $id)->first();
            if(!empty($data['detail']))
                return view('master.karyawan.detail', compact('data'));

            Alert::toast('Data Karyawan Tidak Ditemukan', 'error');
            return redirect()->route('karyawan.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('karyawan.index');
        }
    }

    public function update(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $data['tanggal_pensiun'] = date('Y-m-d', strtotime('+56 years', strtotime($data['tanggal_lahir'])));

            $this->model->update($request->id, $data);
            Alert::toast('Karyawan '.$data['nama_lengkap'].' Berhasil Dirubah', 'success');
            return redirect()->route('karyawan.index');
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
            return redirect()->route('karyawan.index');
        }
    }
}

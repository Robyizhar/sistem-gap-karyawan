<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Karyawan;
use App\Models\Master\KaryawanPKWT;
use App\Repositories\BaseRepository;
use App\Service\ServiceKaryawan;

class DashboardController extends Controller {

    protected $Karyawan, $KaryawanPKWT, $role, $ServiceKaryawan;

    public function __construct(Karyawan $Karyawan, KaryawanPKWT $KaryawanPKWT) {
        $this->Karyawan = new BaseRepository($Karyawan);
        $this->KaryawanPKWT = new BaseRepository($KaryawanPKWT);
        $this->ServiceKaryawan = new ServiceKaryawan;
    }

    public function index() {
        $data = [
            'organik' => $this->Karyawan->get()->count(),
            'pkwt' => $this->KaryawanPKWT->get()->count(), 
            'junior_organik' => $this->ServiceKaryawan->getData(null, null, null, [7,8,9])->get()->count(), 
            'middle_organik' => $this->ServiceKaryawan->getData(null, null, null, [10,11,12])->get()->count(), 
            'senior_organik' => $this->ServiceKaryawan->getData(null, null, null, [13,14,15,16,17,18,19,20])->get()->count()
        ];

        // return $data;

        return view('dashboard.dashboard', compact('data'));
    }

    public function getData() {

    }

    public function create() {

    }

    public function store(Request $request) {

    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
}

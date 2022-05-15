@extends('layouts.main')
@push('style')
<style>
    .form-control {
        background-color: #e3e1e1 !important;
        border: none;
    }
</style>
@endpush
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            @include('layouts.component.breadcumb', ['segment' => Request::segment(2) != '' ? ucwords(str_replace("-"," ",Request::segment(2))) : 'Detail Karyawan'])
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card-box">
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i>Informasi Detail Karyawan</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Nama Lengkap</label>
                                    <span class="form-control">{{ $data['detail']->nama_lengkap }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">NP</label>
                                    <span class="form-control">{{ $data['detail']->np }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Unit Kerja</label>
                                    <span class="form-control">{{ $data['detail']->nama_unit }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Tempat Lahir</label>
                                    <span class="form-control">{{ $data['detail']->tempat_lahir }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Tanggal Lahir</label>
                                    <span class="form-control">{{ date("d-m-Y", strtotime($data['detail']->tanggal_lahir)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Usia</label>
                                    @php
                                        $timezone  = new DateTimeZone('Asia/Jakarta');
                                        $age = DateTime::createFromFormat('Y-m-d', $data['detail']->tanggal_lahir, $timezone)->diff(new DateTime('now', $timezone))->y;
                                    @endphp
                                    <span class="form-control">{{ $age.' Tahun' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Tanggal Masuk</label>
                                    <span class="form-control">{{ date("d-m-Y", strtotime($data['detail']->tanggal_masuk)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Tanggal Pensiun</label>
                                    <span class="form-control">{{ date("d-m-Y", strtotime($data['detail']->tanggal_pensiun)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Sisa Waktu Kerja</label>
                                    @php
                                        $badges = '';
                                        $color = '';
                                        if (strtotime($data['detail']->tanggal_pensiun) == strtotime('now')) {
                                            $badges = 'Pensiun Hari ini';
                                            $color = '#ffc37f';
                                        } elseif (strtotime($data['detail']->tanggal_pensiun) < strtotime('now')) {
                                            $badges = 'Sudah Pensiun';
                                            $color = '#ffbbbb';
                                        } else {
                                            $tanggal_pensiun = date_create_from_format('Y-m-d', $data['detail']->tanggal_pensiun);
                                            $tanggal_sekarang = date_create_from_format('Y-m-d', date('Y-m-d'));
                                            $sisa_waktu_kerja = (array) date_diff($tanggal_pensiun, $tanggal_sekarang);
                                            $badges = $sisa_waktu_kerja['y']. ' Tahun '.$sisa_waktu_kerja['m']. ' Bulan '. $sisa_waktu_kerja['d'] . ' Hari lagi';
                                        }
                                    @endphp
                                    <span style="background-color: {{ $color }}!important;" class="form-control">{{ $badges }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Tanggal Mulai Jabatan</label>
                                    <span class="form-control">{{ date("d-m-Y", strtotime($data['detail']->tmt_jabatan)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Jabatan</label>
                                    <span class="form-control">{{ $data['detail']->nama_jabatan }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Level</label>
                                    <span class="form-control">{{ $data['detail']->nama_level }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Pangkat</label>
                                    <span class="form-control">{{ $data['detail']->nama_pangkat }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
@endpush

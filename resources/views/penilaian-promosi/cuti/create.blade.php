@extends('layouts.main')
@push('style')
<style>
    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 80px;
        /* height: 80px; */
    }
    .lds-ellipsis div {
        position: absolute;
        top: 11px;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: rgb(218, 120, 245);
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(24px, 0);
        }
    }
</style>
@endpush
@section('content')
@component('layouts.component.form')
    @slot('isfile',true)
    @slot('action', !isset($data['detail']) ? route('cuti.store') : route('cuti.update'))
    @isset ($data['detail'])
        @slot('method','PUT')
    @else
        @slot('method','POST')
    @endisset
    @slot('content')
    <div class="row">
        @isset($data['detail'])
            <input type="hidden" value="{{ $data['detail']->id }}" name="id">
        @endisset
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="np">Pilih NP</label>
                <div class="d-flex">
                    <select style="cursor: pointer;" class="form-control" id="np" name="np">
                        <option value="">Pilih NP</option>
                        @foreach ($karyawans as $karyawan)
                            @if ($karyawan->penilaian_karyawan_id == null || $karyawan->penilaian_karyawan_status_promosi == true)
                                <option status_pensiun="{{ $karyawan->penilaian_karyawan_status_promosi }}" data-unit_id="{{ $karyawan->unit_kerja_id }}" data-jabatan="{{ $karyawan->nama_jabatan }}" data-level="{{ $karyawan->nama_level }}" data-pangkat="{{ $karyawan->nama_pangkat }}" data-name="{{ $karyawan->nama_lengkap }}" value="{{ $karyawan->id }}">{{ $karyawan->np }}</option>
                            @elseif(isset($data['detail']) && $data['detail']->np)
                                <option status_pensiun="{{ $karyawan->penilaian_karyawan_status_promosi }}" selected data-unit_id="{{ $karyawan->unit_kerja_id }}" data-jabatan="{{ $karyawan->nama_jabatan }}" data-level="{{ $karyawan->nama_level }}" data-pangkat="{{ $karyawan->nama_pangkat }}" data-name="{{ $karyawan->nama_lengkap }}" value="{{ $karyawan->id }}">{{ $karyawan->np }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @if($errors->has('np')) <div class="text-danger"> {{ $errors->first('np')}} </div>@endif
                <input type="hidden" value="{{ isset($data['detail']) ? $data['detail']->id_unit_kerja : '' }}" name="id_unit_kerja" id="id_unit_kerja">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_lengkap') : old('nama_lengkap', $data['detail']->nama_lengkap) }}" type="text" id="nama_lengkap" class="form-control">
                <input type="hidden" value="{{ isset($data['detail']) ? $data['detail']->id_karyawan : '' }}" name="id_karyawan" id="id_karyawan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="nama_jabatan">Jabatan</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_jabatan') : old('nama_jabatan', $data['detail']->nama_jabatan) }}" type="text" id="nama_jabatan" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nama_level">Level</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_level') : old('nama_level', $data['detail']->nama_level) }}" type="text"  id="nama_level" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nama_pangkat">Pangkat</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_pangkat') : old('nama_pangkat', $data['detail']->nama_pangkat) }}" type="text" id="nama_pangkat" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date">
                @if($errors->has('tanggal_lahir')) <div class="text-danger"> {{ $errors->first('tanggal_lahir')}} </div>@endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input class="form-control" id="tanggal_masuk" name="tanggal_masuk" type="date">
                @if($errors->has('tanggal_masuk')) <div class="text-danger"> {{ $errors->first('tanggal_masuk')}} </div>@endif
            </div>
        </div>

    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>

    function setName(params) {

        $('#nama_lengkap').val(params.value_name)
        $('#nama_jabatan').val(params.value_jabatan)
        $('#nama_pangkat').val(params.value_pangkat)
        $('#nama_level').val(params.value_level)
        $('#id_unit_kerja').val(params.value_unit_id)
        $('#id_karyawan').val(params.value_id_karyawan)

    }

    $('#np').on('change', function (e) {

        let params = {

            value_name: $('option:selected', this).attr('data-name'),
            value_jabatan: $('option:selected', this).attr('data-jabatan'),
            value_pangkat: $('option:selected', this).attr('data-pangkat'),
            value_level: $('option:selected', this).attr('data-level'),
            value_unit_id: $('option:selected', this).attr('data-unit_id'),
            value_id_karyawan: $('option:selected', this).val()

        }

        setName(params);
    });

</script>
@endpush

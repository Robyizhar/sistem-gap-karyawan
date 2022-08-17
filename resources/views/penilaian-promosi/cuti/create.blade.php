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
                <label for="id_karyawan">Pilih NP</label>
                <div class="d-flex">
                    <select style="cursor: pointer;" class="form-control" id="id_karyawan" name="id_karyawan">
                        <option value="">Pilih NP</option>
                        @foreach ($karyawans as $karyawan)
                            @if (!isset($data['detail']))
                                <option status_pensiun="{{ $karyawan->penilaian_karyawan_status_promosi }}" data-jabatan="{{ $karyawan->nama_jabatan }}" data-level="{{ $karyawan->nama_level }}" data-pangkat="{{ $karyawan->nama_pangkat }}" data-name="{{ $karyawan->nama_lengkap }}" value="{{ $karyawan->id }}">{{ $karyawan->np }}</option>
                            @elseif(isset($data['detail']))
                                <option status_pensiun="{{ $karyawan->penilaian_karyawan_status_promosi }}" selected data-jabatan="{{ $karyawan->nama_jabatan }}" data-level="{{ $karyawan->nama_level }}" data-pangkat="{{ $karyawan->nama_pangkat }}" data-name="{{ $karyawan->nama_lengkap }}" value="{{ $karyawan->id }}">{{ $karyawan->np }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @if($errors->has('id_karyawan')) <div class="text-danger"> {{ $errors->first('id_karyawan')}} </div>@endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_lengkap') : old('nama_lengkap', $data['detail']->karyawans->nama_lengkap) }}" type="text" id="nama_lengkap" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="nama_jabatan">Jabatan</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_jabatan') : old('nama_jabatan', $data['detail']->karyawans->jabatan->nama) }}" type="text" id="nama_jabatan" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nama_level">Level</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_level') : old('nama_level', $data['detail']->karyawans->level->nama) }}" type="text"  id="nama_level" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nama_pangkat">Pangkat</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_pangkat') : old('nama_pangkat', $data['detail']->karyawans->pangkat->nama) }}" type="text" id="nama_pangkat" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="start_date">Tanggal Mulai</label>
                <input class="form-control" value="{{ isset($data['detail']) ? $data['detail']->start_date : '' }}" id="start_date" name="start_date" type="date">
                @if($errors->has('start_date')) <div class="text-danger"> {{ $errors->first('start_date')}} </div>@endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="end_date">Tanggal Berakhir</label>
                <input class="form-control" value="{{ isset($data['detail']) ? $data['detail']->end_date : '' }}" id="end_date" name="end_date" type="date">
                @if($errors->has('end_date')) <div class="text-danger"> {{ $errors->first('end_date')}} </div>@endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="file">
                    Form Cuti
                    @if (isset($data['detail']) && $data['detail']->file != "" )
                        <a href="{{ url('storage/'.$data['detail']->file) }}" target="_blank" rel="noopener noreferrer">Lihat File</a>
                        <input value="{{ $data['detail']->file }}" type="hidden" name="old_file" id="old_file" class="form-control">
                    @endif
                </label>
                <div class="input-group">
                    <div class="custom-file">
                        <input accept=".pdf, .doc, .docx" type="file" name="file" class="custom-file-input" id="file">
                        <label class="custom-file-label file" for="file">Format (.pdf, .doc, .docx)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="jenis_cuti">Jenis Cuti</label>
                <div class="d-flex">
                    <select style="cursor: pointer;" class="form-control" id="jenis_cuti" name="jenis_cuti">
                        <option value="">Pilih Jenis Cuti</option>
                        <option value="Cuti Sakit">Cuti Sakit</option>
                        <option value="Cuti Besar">Cuti Besar</option>
                        <option value="Cuti Hamil dan Melahirkan">Cuti Hamil dan Melahirkan</option>
                        <option value="Cuti Penting">Cuti Penting</option>
                    </select>
                </div>
                @if($errors->has('jenis_cuti')) <div class="text-danger"> {{ $errors->first('jenis_cuti')}} </div>@endif
            </div>
        </div>

    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>

    $("#file").change(function() {
        filename = this.files[0].name;
        $('.file').html(filename)
    })

    function setName(params) {

        $('#nama_lengkap').val(params.value_name)
        $('#nama_jabatan').val(params.value_jabatan)
        $('#nama_pangkat').val(params.value_pangkat)
        $('#nama_level').val(params.value_level)
        $('#id_karyawan').val(params.value_id_karyawan)

    }

    $('#id_karyawan').on('change', function (e) {

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

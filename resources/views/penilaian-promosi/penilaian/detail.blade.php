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
    @slot('action', !isset($data['detail']) ? route('penilaian.store') : route('penilaian.update'))
    {{-- @slot('detail',true) --}}
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
                <label for="np">NP</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('np') : old('np', $data['detail']->np) }}" type="text" id="np" class="form-control">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('nama_lengkap') : old('nama_lengkap', $data['detail']->nama_lengkap) }}" type="text" id="nama_lengkap" class="form-control">
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="file_sertifikasi_lsp">
                    File Sertifikasi LSP 
                </label>
                <div class="input-group">
                    <div class="custom-file">
                        <a href="{{ url('storage/'.$data['detail']->file_sertifikasi) }}" target="_blank" rel="noopener noreferrer">Lihat File Sertifikasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="sertifikasi_lsp">Sertifikasi LSP</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data['detail']) ? old('sertifikasi_lsp') : old('sertifikasi_lsp', $data['detail']->sertifikasi_lsp) }}" type="text" id="sertifikasi_lsp" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="no">No Sertifikasi</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ isset($data['detail']) ? $data['detail']->no : '' }}" type="text" name="no" id="no" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nilai_kepatuhan">Nilai Kepatuhan</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ isset($data['detail']) ? $data['detail']->nilai_kepatuhan : '' }}" type="text" name="nilai_kepatuhan" id="nilai_kepatuhan" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nilai_sikap_kerja">Nilai Sikap Kerja</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ isset($data['detail']) ? $data['detail']->nilai_sikap_kerja : '' }}" type="text" name="nilai_sikap_kerja" id="nilai_sikap_kerja" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nilai_inisiatif">Nilai Inisiatif</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ isset($data['detail']) ? $data['detail']->nilai_inisiatif : '' }}" type="text" name="nilai_inisiatif" id="nilai_inisiatif" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="nilai_kedisiplinan">Nilai Kedisiplinan</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ isset($data['detail']) ? $data['detail']->nilai_kedisiplinan : '' }}" type="text" name="nilai_kedisiplinan" id="nilai_kedisiplinan" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="keterangan_hukuman">Keterangan Hukuman</label>
                <textarea readonly class="form-control" id="keterangan_hukuman" name="keterangan_hukuman" rows="5">{{ isset($data['detail']) ? $data['detail']->keterangan_hukuman : '' }}</textarea>
            </div>
        </div>
    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>
    $('.btn-submit').remove();

    $('#form-save-update').submit(function (e) { 
        e.preventDefault();
    });

</script>
@endpush

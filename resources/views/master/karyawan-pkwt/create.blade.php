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
    @slot('isfile',false)
    @slot('action', !isset($data['detail']) ? route('karyawan-pkwt.store') : route('karyawan-pkwt.update'))
    @isset ($data['detail'])
        @slot('method','PUT')
    @else
        @slot('method','POST')
    @endisset
    @slot('content')
    <div class="form-group mb-3">
        <label for="np">NP</label>
        <input type="hidden" value="{{ !isset($data['detail']) ? '' : $data['detail']->id }}" name="id">
        <input value="{{ !isset($data['detail']) ? old('np') : old('np', $data['detail']->np) }}" type="text" name="np" id="np" class="form-control">
        @if($errors->has('np')) <div class="text-danger"> {{ $errors->first('np')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="nama">Nama Lengkap</label>
        <input value="{{ !isset($data['detail']) ? old('nama') : old('nama', $data['detail']->nama) }}" type="text" name="nama" id="nama" class="form-control">
        @if($errors->has('nama')) <div class="text-danger"> {{ $errors->first('nama')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="unit_id">Unit Kerja</label>
        <div class="d-flex">
            <select style="cursor: pointer;" class="form-control" id="unit_id" name="unit_id">
                <option value="">Pilih Unit Kerja</option>
                @foreach ($data['unit'] as $unit)
                    <option {{ isset($data['detail']) && $data['detail']->unit_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->nama }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('unit_id')) <div class="text-danger"> {{ $errors->first('unit_id')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="keterangan">Keterangan</label>
        <input value="{{ !isset($data['detail']) ? old('keterangan') : old('keterangan', $data['detail']->keterangan) }}" type="text" name="keterangan" id="keterangan" class="form-control">
        @if($errors->has('keterangan')) <div class="text-danger"> {{ $errors->first('keterangan')}} </div>@endif
    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>



</script>
@endpush

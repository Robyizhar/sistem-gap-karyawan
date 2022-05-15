@extends('layouts.main')
@push('style')

@endpush
@section('content')
@component('layouts.component.form')
    @slot('isfile',false)
    @slot('action', !isset($data['detail']) ? route('unit.store') : route('unit.update'))
    @isset ($data['detail'])
        @slot('method','PUT')
    @else
        @slot('method','POST')
    @endisset
    @slot('content')
    <div class="form-group mb-3">
        <label for="kode">Kode</label>
        <input type="hidden" value="{{ !isset($data['detail']) ? '' : $data['detail']->id }}" name="id">
        <input value="{{ !isset($data['detail']) ? old('kode') : old('kode', $data['detail']->kode) }}" type="text" name="kode" id="kode" class="form-control">
        @if($errors->has('kode')) <div class="text-danger"> {{ $errors->first('kode')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input value="{{ !isset($data['detail']) ? old('nama') : old('nama', $data['detail']->nama) }}" type="text" name="nama" id="nama" class="form-control">
        @if($errors->has('nama')) <div class="text-danger"> {{ $errors->first('nama')}} </div>@endif
    </div>
    @endslot
@endcomponent
@endsection
@push('script')
@endpush

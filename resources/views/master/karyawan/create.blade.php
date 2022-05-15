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
    @slot('action', !isset($data['detail']) ? route('karyawan.store') : route('karyawan.update'))
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
        <label for="nama_lengkap">Nama Lengkap</label>
        <input value="{{ !isset($data['detail']) ? old('nama_lengkap') : old('nama_lengkap', $data['detail']->nama_lengkap) }}" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
        @if($errors->has('nama_lengkap')) <div class="text-danger"> {{ $errors->first('nama_lengkap')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="tempat_lahir">Tempat Lahir</label>
        <input value="{{ !isset($data['detail']) ? old('tempat_lahir') : old('tempat_lahir', $data['detail']->tempat_lahir) }}" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
        @if($errors->has('tempat_lahir')) <div class="text-danger"> {{ $errors->first('tempat_lahir')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date">
        @if($errors->has('tanggal_lahir')) <div class="text-danger"> {{ $errors->first('tanggal_lahir')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="tanggal_masuk">Tanggal Masuk</label>
        <input class="form-control" id="tanggal_masuk" name="tanggal_masuk" type="date">
        @if($errors->has('tanggal_masuk')) <div class="text-danger"> {{ $errors->first('tanggal_masuk')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="tmt_jabatan">TMT Jabatan</label>
        <input class="form-control" id="tmt_jabatan" name="tmt_jabatan" type="date">
        @if($errors->has('tmt_jabatan')) <div class="text-danger"> {{ $errors->first('tmt_jabatan')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="unit_kerja_id">Unit Kerja</label>
        <div class="d-flex">
            <select style="cursor: pointer;" class="form-control" id="unit_kerja_id" name="unit_kerja_id">
                <option value="">Pilih Unit Kerja</option>
                @foreach ($data['unit'] as $unit)
                    <option {{ isset($data['detail']) && $data['detail']->unit_kerja_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->nama }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('unit_kerja_id')) <div class="text-danger"> {{ $errors->first('unit_kerja_id')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="jabatan_id">Jabatan</label>
        <div class="d-flex">
            <select style="background-color: #e9e7e7; cursor: not-allowed" class="form-control" id="jabatan_id" name="jabatan_id">
                <option value="">Pilih Jabatan</option>
            </select>
        </div>
        @if($errors->has('jabatan_id')) <div class="text-danger"> {{ $errors->first('jabatan_id')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="pangkat_id">Pangkat</label>
        <div class="d-flex">
            <select disabled="true" style="background-color: #e9e7e7; cursor: not-allowed" class="form-control" id="pangkat_id" name="pangkat_id">
                <option value="">Pilih Pangkat</option>
            </select>
        </div>
        @if($errors->has('pangkat_id')) <div class="text-danger"> {{ $errors->first('pangkat_id')}} </div>@endif
    </div>
    <div class="form-group mb-3">
        <label for="level_id">Level</label>
        <div class="d-flex">
            <select disabled="true" style="background-color: #e9e7e7; cursor: not-allowed" class="form-control" id="level_id" name="level_id">
                <option value="">Pilih Level</option>
            </select>
        </div>
        @if($errors->has('level_id')) <div class="text-danger"> {{ $errors->first('level_id')}} </div>@endif
    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>

    function getJabatan(params, current_id = null) {

        let unit_kerja_id = params;
        let actionUrl = `{{ route('karyawan.get-jabatan') }}`;

        $("#jabatan_id").find('option').not(':first').remove();
        $("#pangkat_id").find('option').not(':first').remove();
        $("#level_id").find('option').not(':first').remove();

        $("#pangkat_id").attr("disabled", true);
        $("#pangkat_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

        $("#level_id").attr("disabled", true);
        $("#level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

        if (unit_kerja_id != "") {

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: { unit_kerja_id: unit_kerja_id },
                success: function(data) {
                    const jabatan = (typeof data == "string") ? jQuery.parseJSON(data) : data;
                    jabatan.forEach(index => {
                        if (current_id != null && index.id == current_id) {
                            let jabatan_option = `<option selected value="${index.id}">${index.nama}</option>`;
                            $("#jabatan_id").append(jabatan_option);

                        } else {
                            let jabatan_option = `<option value="${index.id}">${index.nama}</option>`;
                            $("#jabatan_id").append(jabatan_option);

                        }
                    });
                    $(".lds-ellipsis").remove();
                    $("#jabatan_id").attr("disabled", false);
                    $("#jabatan_id").css("background-color", "#FFFF").css("cursor", "pointer");
                }
            });

        } else {

            $(".lds-ellipsis").remove();
            $("#jabatan_id").attr("disabled", true);
            $("#jabatan_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

        }
    }

    function getPangkat(params, current_id = null) {

        let jabatan_id = params;
        let unit_kerja_id = $("#unit_kerja_id").val();
        let actionUrl = `{{ route('karyawan.get-pangkat') }}`;

        $("#pangkat_id").find('option').not(':first').remove();
        $("#level_id").find('option').not(':first').remove();

        $("#level_id").attr("disabled", true);
        $("#level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

        if (jabatan_id != "") {
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: {
                    jabatan_id: jabatan_id,
                    unit_kerja_id: unit_kerja_id
                },
                success: function(data) {
                    const pangkat = (typeof data == "string") ? jQuery.parseJSON(data) : data;
                    pangkat.forEach(index => {
                        if (current_id != null && index.id == current_id) {
                            let pangkat_option = `<option selected value="${index.id}">${index.nama}</option>`
                            $("#pangkat_id").append(pangkat_option);
                        } else {
                            let pangkat_option = `<option value="${index.id}">${index.nama}</option>`
                            $("#pangkat_id").append(pangkat_option);
                        }
                    });
                    $(".lds-ellipsis").remove();
                    $("#pangkat_id").attr("disabled", false);
                    $("#pangkat_id").css("background-color", "#FFFF").css("cursor", "pointer");
                }
            });
        } else {

            $(".lds-ellipsis").remove();
            $("#pangkat_id").attr("disabled", true);
            $("#pangkat_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

        }
    }

    function getLevel(params, current_jabatan_id = null, current_id = null) {
        let pangkat_id = params;
        let unit_kerja_id = $("#unit_kerja_id").val();
        let jabatan_id = $("#jabatan_id").val();
        if (current_jabatan_id != null)
            jabatan_id = current_jabatan_id;

        let actionUrl = `{{ route('karyawan.get-level') }}`;
        console.log("Pangkat : "+pangkat_id);
        console.log("Unit Kerja : "+unit_kerja_id);
        console.log("Jabatan : "+jabatan_id);
        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        $("#level_id").find('option').not(':first').remove();
        if (pangkat_id != "") {
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: {
                    pangkat_id: pangkat_id,
                    unit_kerja_id: unit_kerja_id,
                    jabatan_id: jabatan_id
                },
                success: function(data) {
                    const level = (typeof data == "string") ? jQuery.parseJSON(data) : data;
                    level.forEach(index => {
                        if (current_id != null && index.id == current_id) {
                            let level_option = `<option selected value="${index.id}">${index.nama}</option>`
                            $("#level_id").append(level_option);
                        } else {
                            let level_option = `<option value="${index.id}">${index.nama}</option>`
                            $("#level_id").append(level_option);
                        }
                    });
                    $(".lds-ellipsis").remove();
                    $("#level_id").attr("disabled", false);
                    $("#level_id").css("background-color", "#FFFF").css("cursor", "pointer");
                }
            });
        } else {
            $(".lds-ellipsis").remove();
            $("#level_id").attr("disabled", true);
            $("#level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");
        }
    }

    $('#unit_kerja_id').on('change', function (e) {
        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        let unit_kerja_id = $(this).val();
        getJabatan(unit_kerja_id);
    });

    $('#jabatan_id').on('change', function (e) {
        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        let jabatan_id = $(this).val();
        getPangkat(jabatan_id)
    });

    $('#pangkat_id').on('change', function (e) {
        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        let pangkat_id = $(this).val();
        getLevel(pangkat_id)
    });

</script>
@isset($data['detail'])
    <script>
        let tanggal_lahir = `{{ date("Y-m-d", strtotime($data['detail']->tanggal_lahir)) }}`;
        $("#tanggal_lahir").val(tanggal_lahir);

        let tanggal_masuk = `{{ date("Y-m-d", strtotime($data['detail']->tanggal_masuk)) }}`;
        $("#tanggal_masuk").val(tanggal_masuk);

        let tmt_jabatan = `{{ date("Y-m-d", strtotime($data['detail']->tmt_jabatan)) }}`;
        $("#tmt_jabatan").val(tmt_jabatan);

        let unit_id = `{{ $data['detail']->unit_kerja_id }}`;
        let jabatan_id = `{{ $data['detail']->jabatan_id }}`;
        let pangkat_id = `{{ $data['detail']->pangkat_id }}`;
        let level_id = `{{ $data['detail']->level_id }}`;

        getJabatan(unit_id, jabatan_id);
        getPangkat(jabatan_id, pangkat_id);
        getLevel(pangkat_id, jabatan_id, level_id)

        console.log(pangkat_id);

    </script>
@endisset
@endpush

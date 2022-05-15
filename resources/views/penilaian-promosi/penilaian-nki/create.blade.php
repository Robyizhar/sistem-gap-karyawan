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
    @slot('action', !isset($data) ? route('penilaian-nki.store') : route('penilaian-nki.update'))
    @isset ($data)
        @slot('method','PUT')
    @else
        @slot('method','POST')
    @endisset
    @slot('content')
    <div class="row">
        @isset($data)
            <input type="hidden" value="{{ $data->id }}" name="id">
        @endisset
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="np">Pilih NP</label>
                <div class="d-flex">
                    <select style="cursor: pointer;" class="form-control" id="np">
                        <option value="">Pilih NP</option>
                        @foreach ($karyawans as $karyawan)
                            <option data-unit_id="{{ $karyawan->unit_id }}" data-name="{{ $karyawan->nama }}" value="{{ $karyawan->id }}">{{ $karyawan->np }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('np')) <div class="text-danger"> {{ $errors->first('np')}} </div>@endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="{{ !isset($data) ? old('nama_lengkap') : old('nama_lengkap', $data->nama_lengkap) }}" type="text" id="nama_lengkap" class="form-control">
                <input type="hidden" value="{{ isset($data) ? $data->karyawan_id : '' }}" name="karyawan_id" id="karyawan_id">
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($index_penilaian as $penilaian)
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label><strong>{{ $penilaian->question }}</strong></label>
                <br>

                @if (isset($index_penilaians))
                    @foreach ($index_penilaians as $key => $value)
                        @if ($key == $penilaian->question)
                            <label class="mr-3">
                                <input type="radio" class="" id="item_checkbox" name="penilaian[{{$penilaian->question}}]" value="1"
                                {{ !isset($index_penilaians) || isset($index_penilaians) && $value == 1 ? 'checked' : '' }}>
                                <span class=""> {{ 'Ya' }} </span>
                            </label>
                            <label class="mr-3">
                                <input type="radio" class="" id="item_checkbox" name="penilaian[{{$penilaian->question}}]" value="0"
                                {{ isset($index_penilaians) && $value == 0 ? 'checked' : '' }}>
                                <span class=""> {{ 'Tidak' }} </span>
                            </label>
                        @endif
                    @endforeach
                @else
                    <label class="mr-3">
                        <input type="radio" class="" id="item_checkbox" name="penilaian[{{$penilaian->question}}]" value="1"
                        {{ !isset($index_penilaians) || isset($index_penilaians) && $index_penilaians[$penilaian->question] == 1 ? 'checked' : '' }}>
                        <span class=""> {{ 'Ya' }} </span>
                    </label>
                    <label class="mr-3">
                        <input type="radio" class="" id="item_checkbox" name="penilaian[{{$penilaian->question}}]" value="0"
                        {{ isset($index_penilaians) && $index_penilaians[$penilaian->question] == 0 ? 'checked' : '' }}>
                        <span class=""> {{ 'Tidak' }} </span>
                    </label>
                @endif

            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="keterangan_hukuman">Keterangan Hukuman</label>
                <textarea class="form-control" id="keterangan_hukuman" rows="5">{{ isset($data) ? '' : '' }}</textarea>
            </div>
        </div>
    </div>
    @endslot
@endcomponent
@endsection
@push('script')
<script>

    $("#file_sertifikasi_lsp").change(function() {
        filename = this.files[0].name;
        $('.file_sertifikasi_lsp').html(filename)
    });

    function setName(params) {

        $('#nama_lengkap').val(params.value_name)
        $('#id_unit_kerja').val(params.value_unit_id)
        $('#karyawan_id').val(params.value_id_karyawan)

    }

    $('#np').on('change', function (e) {

        let params = {

            value_name: $('option:selected', this).attr('data-name'),

            value_unit_id: $('option:selected', this).attr('data-unit_id'),
            value_id_karyawan: $('option:selected', this).val()

        }

        setName(params);
    });

</script>
{{-- @isset($data['detail'])
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
@endisset --}}
@endpush

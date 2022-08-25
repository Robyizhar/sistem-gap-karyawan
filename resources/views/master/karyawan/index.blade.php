@extends('layouts.main')
@push('style')
<style>
.form-process {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 3;
    background-color: transparent;
    width: 100%;
    height: 100%;
    background: center center no-repeat #ffffffa8;
}

.css3-spinner {
    position: absolute;
    z-index: auto;
    background-color: transparent;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    text-align: center;
    background-color: #ffffff40;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-perspective: 1000;
}
.lds-ring, .lds-ring div {
    box-sizing: border-box;
}
.lds-ring {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    top: 50%;
}
.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid currentColor;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: currentColor transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}
@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
@endpush
@section('content')
    @component('layouts.component.datatable')
        @slot('action', route('karyawan.create'))
        @slot('content')
            @if ( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Karyawan']))
            <div class="row">
                <div class="form-group col-3">
                    <label for="unit">Unit</label>
                    <div class="d-flex">
                        <select style="cursor: pointer;" class="form-control filter-employee" id="unit" name="unit">
                            <option value="">Pilih Unit</option>
                            @foreach ($data['unit'] as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="level">Level</label>
                    <div class="d-flex">
                        <select style="cursor: pointer;" class="form-control filter-employee" id="level" name="level">
                            <option value="">Pilih Level</option>
                            @foreach ($data['level'] as $level)
                                <option value="{{ $level->id }}">{{ $level->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="pangkat">Pangkat</label>
                    <div class="d-flex">
                        <select style="cursor: pointer;" class="form-control filter-employee" id="pangkat" name="pangkat">
                            <option value="">Pilih Pangkat</option>
                            @foreach ($data['pangkat'] as $pangkat)
                                <option value="{{ $pangkat->id }}">{{ $pangkat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="status_pensiun">Status</label>
                    <div class="d-flex">
                        <select style="cursor: pointer;" class="form-control filter-employee" id="status_pensiun" name="status_pensiun">
                            <option value="aktif">Aktif</option>
                            <option value="pensiun">Pensiun</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif
            <th width="12px;">NO</th>
            <th>NP</th>
            <th>NAMA LENGKAP</th>
            <th>UNIT KERJA</th>
            {{-- <th>JABATAN</th>
            <th>LEVEL</th>
            <th>GRADE</th> --}}
            <th>LAMA MENJABAT</th>
            <th>STATUS PENILAIAN</th>
            <th>STATUS PENSIUN</th>
            <th width="20%">AKSI</th>
        @endslot
    @endcomponent
@endsection
@push('script')
<script>
$(document).ready( function () {
    $('#unit').change(function (e) {
        e.preventDefault();
        let this_unit = $(this).val();
        let this_level = $('#level').val();
        let this_pangkat =$('#pangkat').val();
        let status_pensiun =$('#status_pensiun').val();
        getData(this_unit, this_level, this_pangkat, status_pensiun);
    });
    $('#level').change(function (e) {
        e.preventDefault();
        let this_level = $(this).val();
        let this_unit = $('#unit').val();
        let this_pangkat =$('#pangkat').val();
        let status_pensiun =$('#status_pensiun').val();
        getData(this_unit, this_level, this_pangkat, status_pensiun);
    });
    $('#pangkat').change(function (e) {
        e.preventDefault();
        let this_pangkat = $(this).val();
        let this_level = $('#level').val();
        let this_unit = $('#unit').val();
        let status_pensiun =$('#status_pensiun').val();
        getData(this_unit, this_level, this_pangkat, status_pensiun);
    });
    $('#status_pensiun').change(function (e) {
        e.preventDefault();
        let status_pensiun = $(this).val();
        let this_level = $('#level').val();
        let this_unit =$('#unit').val();
        let this_pangkat =$('#pangkat').val();
        getData(this_unit, this_level, this_pangkat, status_pensiun);
    });
});
function getData(unit, level, pangkat, status_pensiun) {

    $('.form-process').css('display', 'block');

    if ( $.fn.DataTable.isDataTable( '#state-saving-datatable' ) ) {
        $( '#state-saving-datatable' ).DataTable().destroy();
    }

    console.log(status_pensiun);

    let datatable = $('#state-saving-datatable').DataTable({
        destroy: true,
        responsive: true,
        processing: true,
        serverSide: true,
        method: "POST",
        sPaginationType: "full_numbers",
        ajax: {
            url: "{!! url('karyawan/get-data') !!}",
            type: "POST",
            dataType: "JSON",
            "dataSrc": function ( json ) {
                $('.form-process').css('display', 'none');
                return json.data;
            },
            data: {
                    "unit": unit,
                    "level": level,
                    "pangkat": pangkat,
                    "status_pensiun": status_pensiun
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'np', name: 'np'},
            {data: 'nama_lengkap', name: 'nama_lengkap'},
            {data: 'kode_unit', name: 'kode_unit'},
            // {data: 'nama_jabatan', name: 'nama_jabatan'},
            // {data: 'nama_level', name: 'nama_level'},
            // {data: 'nama_pangkat', name: 'nama_pangkat'},
            {data: 'Lama_Jabatan', name: 'Lama_Jabatan'},
            {data: 'Status_Penilaian'},
            {data: 'Status_Pensiun'},
            {data: 'Action', name: 'Action'}
        ]
    });
}
// getData()
</script>
@endpush

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
        @slot('action', route('karyawan-pkwt.create'))
        @slot('content')
            <th width="12px;">NO</th>
            <th>NP</th>
            <th>NAMA LENGKAP</th>
            <th>UNIT KERJA</th>
            <th>STATUS</th>
            <th>KETERANGAN</th>
            <th width="25%">AKSI</th>
        @endslot
    @endcomponent
@endsection
@push('script')
<script>
$(document).ready( function () {
    $('.form-process').css('display', 'block');
    let datatable = $('#state-saving-datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        method: "POST",
        sPaginationType: "full_numbers",
        ajax: {
            url: "{!! url('karyawan-pkwt/get-data') !!}",
            type: "POST",
            dataType: "JSON",
            "dataSrc": function ( json ) {
                $('.form-process').css('display', 'none');
                return json.data;
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'np', name: 'np'},
            {data: 'nama', name: 'nama'},
            {data: 'nama_unit', name: 'nama_unit'},
            {data: 'status', name: 'status'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'Action', name: 'Action'}
        ]
    });
});

</script>
@endpush

@extends('layouts.main')
@push('style')
<style>

</style>
@endpush
@section('content')
    @component('layouts.component.datatable')
        @slot('action', '#')
        @slot('content')
            <th width="12px;">NO</th>
            <th>NP</th>
            <th>NAMA LENGKAP</th>
            <th>STATUS KONTRAK</th>
            <th width="10%">AKSI</th>
        @endslot
    @endcomponent
    <div id="full-width-modal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" style="display: none; padding-right: 17px;" aria-modal="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Detail Informasi Penilaian Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div style="border: 1px solid #9f9f9f"></div>
                </div>
                <div class="modal-body">
                    <h4>Data Karyawan</h4>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="np">NP</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="6787" type="text" id="np" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_unit">Unit Kerja</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama_unit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="kontrak_ke">Kontrak Sebelumnya</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="6787" type="text" id="kontrak_ke" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="tanggal_mulai" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tanggal_berakhir">Tanggal Berakhir</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="tanggal_berakhir" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Detail Penilaian</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group index_penilaian">


                            </ul>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Valid</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>

$('.btn-add').remove();

$(document).ready( function () {

    $('.form-process').css('display', 'block');

    var datatable = $('#state-saving-datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        method: "POST",
        sPaginationType: "full_numbers",
        ajax: {
            url: "{!! url('kontrak/get-data') !!}",
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
            {data: 'status_kontrak', name: 'status_kontrak'},
            {data: 'Action', name: 'Action'}
        ]
    });

    $(document).on('click', '.detail_kontrak', function(e) {
        $(".modal-footer").empty();
        $(".index_penilaian").empty();
        let id = $(this).data('id');
        let np = $(this).data('np');
        let nama = $(this).data('nama');
        let kontrak_ke = $(this).data('kontrak_ke');
        let tanggal_mulai = $(this).data('tanggal_mulai');
        let tanggal_berakhir = $(this).data('tanggal_berakhir');
        let index_penilaian = $(this).data('index_penilaian');
        let nama_unit = $(this).data('nama_unit');

        if ($(this).data("status_kontrak") != false) {
            // $('.nilai-detail').css("display", "none")
            $(".modal-footer").append('<button type="button" class="btn btn-danger cancel-valid">Batalkan Validasi</button>')
            $(".modal-footer").append('<button type="button" class="btn btn-light not-valid" data-dismiss="modal">Close</button>')
        } else {
            // $('.nilai-detail').css("display", "flex")
            $(".modal-footer").append('<button type="button" class="btn btn-primary valid">Valid</button>')
            $(".modal-footer").append('<button type="button" class="btn btn-light not-valid" data-dismiss="modal">Close</button>')
        }

        $('#id').val(id)
        $('#np').val(np)
        $('#nama').val(nama)
        $('#nama_unit').val(nama_unit)
        $('#kontrak_ke').val(kontrak_ke)
        $('#tanggal_mulai').val(tanggal_mulai)
        $('#tanggal_berakhir').val(tanggal_berakhir)

        $.map(index_penilaian, function (value, key) {
            let answer = 'Tidak';
            if(value == 1)
                answer = 'Ya';

            $('.index_penilaian').append(`
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${key}
                    <span class="badge badge-primary badge-pill">${answer}</span>
                </li>
            `)
        });
    });

    $(document).on('click', '.valid', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        $('.form-process').css('display', 'block');

        let id = $('#id').val();
        let kontrak_ke = $('#kontrak_ke').val();
        let tanggal_mulai = $('#tanggal_mulai').val();
        let tanggal_berakhir = $('#tanggal_berakhir').val();

        $.ajax({
            url: '{{ route('kontrak.store') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": 'POST',
                id: id,
                kontrak_ke: kontrak_ke,
                tanggal_mulai: tanggal_mulai,
                tanggal_berakhir: tanggal_berakhir
            },
            success: function(response) {
                console.log(response);
                datatable.ajax.reload(null, false);
                $('.form-process').css('display', 'none');
                $('#full-width-modal').hide();
                $('.modal-backdrop').hide();

            },error: function (request, status, error) {
                let errorMessage = request.responseJSON.errors;
                printErrorMessage(errorMessage)
                $('.form-process').css('display', 'none');
                $('#full-width-modal').hide();
                $('.modal-backdrop').hide();

            }
        });
    });

    $(document).on('click', '.cancel-valid', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        $('.form-process').css('display', 'block');

        let id = $('#id').val();
        let kontrak_ke = $('#kontrak_ke').val();
        let tanggal_mulai = $('#tanggal_mulai').val();
        let tanggal_berakhir = $('#tanggal_berakhir').val();

        $.ajax({
            url: '{{ route('kontrak.cancel-valid') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": 'POST',
                id: id,
                kontrak_ke: kontrak_ke,
                tanggal_mulai: tanggal_mulai,
                tanggal_berakhir: tanggal_berakhir
            },
            success: function(response) {
                console.log(response);
                datatable.ajax.reload(null, false);
                $('.form-process').css('display', 'none');
                $('#full-width-modal').hide();
                $('.modal-backdrop').hide();

            },error: function (request, status, error) {
                let errorMessage = request.responseJSON.errors;
                printErrorMessage(errorMessage)
                $('.form-process').css('display', 'none');
                $('#full-width-modal').hide();
                $('.modal-backdrop').hide();

            }
        });
    });

});

</script>
@endpush

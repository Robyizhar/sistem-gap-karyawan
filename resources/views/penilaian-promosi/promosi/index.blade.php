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
            <th>STATUS PROMOSI</th>
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
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama_lengkap" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_unit">Unit Kerja</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama_unit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_jabatan">Jabatan</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="6787" type="text" id="nama_jabatan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_level">Level</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama_level" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_pangkat">Pangkat</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="Ronaldo" type="text" id="nama_pangkat" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Detail Penilaian</h4>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nilai_kedisiplinan">Nilai Kedisiplinan</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="6787" type="text" id="nilai_kedisiplinan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nilai_kepatuhan">Nilai Kepatuhan</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="nilai_kepatuhan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nilai_sikap_kerja">Nilai Sikap Kerja</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="nilai_sikap_kerja" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nilai_inisiatif">Nilai Inisiatif</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="nilai_inisiatif" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="waktu_penilaian">Tanggal Penilaian</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="waktu_penilaian" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="persentase">Presentase Penilaian</label>
                                <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="persentase" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Sertifikasi</h4>
                    <div class="row sertifikasi-detail">
                        <div class="col-md-6">
                            <label for="file_sertifikasi">File Sertifikasi</label>
                            <br>
                            <a href="http://" id="file_sertifikasi" target="_blank" rel="noopener noreferrer">Lihat Sertifikasi</a>
                        </div>
                        <div class="col-md-6">
                            <label for="no_sertifikasi">No Sertifikasi</label>
                            <input style="background-color: #e9e7e7; cursor: not-allowed" readonly value="" type="text" id="no_sertifikasi" class="form-control">
                        </div>
                    </div>
                    <div class="row nilai-detail">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_jabatan_id">Jabatan</label>
                                <div class="d-flex">
                                    <select class="form-control" id="new_jabatan_id" name="new_jabatan_id">
                                        <option value="">Pilih Jabatan</option>
                                    </select>
                                </div>
                                <span class="error-message new_jabatan_id" style="color: #b30000; font-size: 0.7rem;"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_pangkat_id">Pangkat</label>
                                <div class="d-flex">
                                    <select disabled="true" style="background-color: #e9e7e7; cursor: not-allowed" class="form-control" id="new_pangkat_id" name="new_pangkat_id">
                                        <option value="">Pilih Pangkat</option>
                                    </select>
                                </div>
                                <span class="error-message new_pangkat_id" style="color: #b30000; font-size: 0.7rem;"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_level_id">Level</label>
                                <div class="d-flex">
                                    <select disabled="true" style="background-color: #e9e7e7; cursor: not-allowed" class="form-control" id="new_level_id" name="new_level_id">
                                        <option value="">Pilih Level</option>
                                    </select>
                                </div>
                                <span class="error-message new_level_id" style="color: #b30000; font-size: 0.7rem;"></span>
                            </div>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="penilaian_karyawan_id" id="penilaian_karyawan_id">
                <input type="hidden" name="unit_id" id="unit_id">
                <input type="hidden" name="jabatan_id" id="jabatan_id">
                <input type="hidden" name="pangkat_id" id="pangkat_id">
                <input type="hidden" name="level_id" id="level_id">
                <input type="hidden" name="id_karyawan" id="id_karyawan">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="tmt_sebelumnya" id="tmt_sebelumnya">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
            url: "{!! url('promosi/get-data') !!}",
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
            {data: 'nama_lengkap', name: 'nama_lengkap'},
            {data: 'status_promosi', name: 'status_promosi'},
            {data: 'Action', name: 'Action'}
        ]
    });

    $(document).on('click', '.detail_promosi', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();

        $(".modal-footer").empty();
        $('#penilaian_karyawan_id').val($(this).data("penilaian_karyawan_id"));
        $('#unit_id').val($(this).data("id_unit"));
        $('#jabatan_id').val($(this).data("id_jabatan"));
        $('#level_id').val($(this).data("id_level"));
        $('#pangkat_id').val($(this).data("id_pangkat"));
        $('#id_karyawan').val($(this).data("id_karyawan"));

        $('#tmt_sebelumnya').val($(this).data("tmt_jabatan"));

        $('#np').val($(this).data("np"));
        $('#nama_lengkap').val($(this).data("nama_lengkap"));
        $('#nama_level').val($(this).data("nama_level"));
        $('#nama_jabatan').val($(this).data("nama_jabatan"));
        $('#nama_pangkat').val($(this).data("nama_pangkat"));
        $('#nama_unit').val($(this).data("nama_unit"));
        let url = `{!! url('/') !!}`;
        let file = $(this).data("file_sertifikasi");
        $('#file_sertifikasi').attr("href", url+'/storage/'+file);
        $('#no_sertifikasi').val($(this).data("no_sertifikasi"));
        $('#id').val($(this).data("id"));

        $('#nilai_kedisiplinan').val($(this).data("nilai_kedisiplinan"));
        if (parseInt($(this).data("nilai_kedisiplinan")) < 60) {
            $('#nilai_kedisiplinan').css("background-color", "#e9a4a4")
        } else if(parseInt($(this).data("nilai_kedisiplinan")) >= 60 && parseInt($(this).data("nilai_kedisiplinan")) < 80){
            $('#nilai_kedisiplinan').css("background-color", "#e9e5a4")
        } else {
            $('#nilai_kedisiplinan').css("background-color", "#c6e9a4")
        }

        $('#nilai_kepatuhan').val($(this).data("nilai_kepatuhan"));
        if (parseInt($(this).data("nilai_kepatuhan")) < 60) {
            $('#nilai_kepatuhan').css("background-color", "#e9a4a4")
        } else if(parseInt($(this).data("nilai_kepatuhan")) >= 60 && parseInt($(this).data("nilai_kepatuhan")) < 80){
            $('#nilai_kepatuhan').css("background-color", "#e9e5a4")
        } else {
            $('#nilai_kepatuhan').css("background-color", "#c6e9a4")
        }

        $('#nilai_sikap_kerja').val($(this).data("nilai_sikap_kerja"));
        if (parseInt($(this).data("nilai_sikap_kerja")) < 60) {
            $('#nilai_sikap_kerja').css("background-color", "#e9a4a4")
        } else if(parseInt($(this).data("nilai_sikap_kerja")) >= 60 && parseInt($(this).data("nilai_sikap_kerja")) < 80){
            $('#nilai_sikap_kerja').css("background-color", "#e9e5a4")
        } else {
            $('#nilai_sikap_kerja').css("background-color", "#c6e9a4")
        }

        $('#nilai_inisiatif').val($(this).data("nilai_inisiatif"));
        if (parseInt($(this).data("nilai_inisiatif")) < 60) {
            $('#nilai_inisiatif').css("background-color", "#e9a4a4")
        } else if(parseInt($(this).data("nilai_inisiatif")) >= 60 && parseInt($(this).data("nilai_inisiatif")) < 80){
            $('#nilai_inisiatif').css("background-color", "#e9e5a4")
        } else {
            $('#nilai_inisiatif').css("background-color", "#c6e9a4")
        }

        $('#waktu_penilaian').val($(this).data("waktu_penilaian"));

        $('#persentase').val($(this).data("persentase"));
        if (parseFloat($(this).data("persentase")) < 60) {
            $('#persentase').css("background-color", "#e9a4a4")
        } else if(parseFloat($(this).data("persentase")) >= 60 && parseFloat($(this).data("persentase")) < 80){
            $('#persentase').css("background-color", "#e9e5a4")
        } else {
            $('#persentase').css("background-color", "#c6e9a4")
        }

        if ($(this).data("id") != "") {
            $('.nilai-detail').css("display", "none")
            $(".modal-footer").append('<button type="button" class="btn btn-danger cancel-valid">Batalkan Validasi</button>')
            $(".modal-footer").append('<button type="button" class="btn btn-light not-valid" data-dismiss="modal">Close</button>')
        } else {
            $('.nilai-detail').css("display", "flex")
            $(".modal-footer").append('<button type="button" class="btn btn-primary valid">Valid</button>')
            // $(".modal-footer").append('<button type="button" class="btn btn-danger not-valid">Belum Valid</button>')
            $(".modal-footer").append('<button type="button" class="btn btn-light not-valid" data-dismiss="modal">Close</button>')

            let unit_kerja_id = $(this).data("id_unit");
            getJabatan(unit_kerja_id);
        }

    });

    $(document).on('change', '#new_jabatan_id', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();

        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        let jabatan_id = $(this).val();
        getPangkat(jabatan_id);
    });

    $(document).on('change', '#new_pangkat_id', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();

        $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        let pangkat_id = $(this).val();
        getLevel(pangkat_id)
    });

    $(document).on('click', '.valid', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();

        $('.form-process').css('display', 'block');

        let penilaian_karyawan_id = $('#penilaian_karyawan_id').val();
        let unit_id = $('#unit_id').val();
        let jabatan_id = $('#jabatan_id').val();
        let level_id = $('#level_id').val();
        let pangkat_id = $('#pangkat_id').val();

        $.ajax({
            url: '{{ route('promosi.store') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": 'POST',
                penilaian_karyawan_id: penilaian_karyawan_id,
                unit_kerja_id: unit_id,
                jabatan_id: jabatan_id,
                level_id: level_id,
                pangkat_id: pangkat_id,
                new_jabatan_id: $('#new_jabatan_id').val(),
                new_pangkat_id: $('#new_pangkat_id').val(),
                new_level_id: $('#new_level_id').val(),
                id_karyawan: $('#id_karyawan').val(),
                tmt_sebelumnya: $('#tmt_sebelumnya').val()
            },
            success: function(response) {
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

        let penilaian_karyawan_id = $('#penilaian_karyawan_id').val();
        let unit_id = $('#unit_id').val();
        let jabatan_id = $('#jabatan_id').val();
        let level_id = $('#level_id').val();
        let pangkat_id = $('#pangkat_id').val();

        $.ajax({
            url: '{{ route('promosi.cancel-valid') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": 'POST',
                penilaian_karyawan_id: penilaian_karyawan_id,
                unit_kerja_id: unit_id,
                jabatan_id: jabatan_id,
                level_id: level_id,
                pangkat_id: pangkat_id,
                new_jabatan_id: $('#new_jabatan_id').val(),
                new_pangkat_id: $('#new_pangkat_id').val(),
                new_level_id: $('#new_level_id').val(),
                id_karyawan: $('#id_karyawan').val(),
                id: $('#id').val()
            },
            success: function(response) {
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

function printErrorMessage(params) {

    let errorMessage = Object.keys(params)
    console.log(errorMessage);
    errorMessage.forEach(value => {
        // console.log(value);
        $(document).find('.'+new_level_id).html('Silahkan Pilih salah satu')
    });
}

function getJabatan(params, current_id = null) {

    let unit_kerja_id = params;
    let actionUrl = `{{ route('karyawan.get-jabatan') }}`;

    $("#new_jabatan_id").find('option').not(':first').remove();
    $("#new_pangkat_id").find('option').not(':first').remove();
    $("#new_level_id").find('option').not(':first').remove();

    $("#new_pangkat_id").attr("disabled", true);
    $("#new_pangkat_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

    $("#new_level_id").attr("disabled", true);
    $("#new_level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

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
                        $("#new_jabatan_id").append(jabatan_option);

                    } else {
                        let jabatan_option = `<option value="${index.id}">${index.nama}</option>`;
                        $("#new_jabatan_id").append(jabatan_option);

                    }
                });
                $(".lds-ellipsis").remove();
                $("#new_jabatan_id").attr("disabled", false);
                $("#new_jabatan_id").css("background-color", "#FFFF").css("cursor", "pointer");
            }
        });

    } else {

        $(".lds-ellipsis").remove();
        $("#new_jabatan_id").attr("disabled", true);
        $("#new_jabatan_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

    }
}

function getPangkat(params, current_id = null) {

    let jabatan_id = params;
    let unit_kerja_id = $("#unit_id").val();
    let actionUrl = `{{ route('karyawan.get-pangkat') }}`;

    $("#new_pangkat_id").find('option').not(':first').remove();
    $("#new_level_id").find('option').not(':first').remove();

    $("#new_level_id").attr("disabled", true);
    $("#new_level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

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
                        $("#new_pangkat_id").append(pangkat_option);
                    } else {
                        let pangkat_option = `<option value="${index.id}">${index.nama}</option>`
                        $("#new_pangkat_id").append(pangkat_option);
                    }
                });
                $(".lds-ellipsis").remove();
                $("#new_pangkat_id").attr("disabled", false);
                $("#new_pangkat_id").css("background-color", "#FFFF").css("cursor", "pointer");
            }
        });
    } else {

        $(".lds-ellipsis").remove();
        $("#new_pangkat_id").attr("disabled", true);
        $("#new_pangkat_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");

    }
}

function getLevel(params, current_jabatan_id = null, current_id = null) {
    let pangkat_id = params;
    let unit_kerja_id = $("#unit_id").val();
    let jabatan_id = $("#new_jabatan_id").val();
    if (current_jabatan_id != null)
        jabatan_id = current_jabatan_id;

    let actionUrl = `{{ route('karyawan.get-level') }}`;

    $(this).parent().append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
    $("#new_level_id").find('option').not(':first').remove();
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
                        $("#new_level_id").append(level_option);
                    } else {
                        let level_option = `<option value="${index.id}">${index.nama}</option>`
                        $("#new_level_id").append(level_option);
                    }
                });
                $(".lds-ellipsis").remove();
                $("#new_level_id").attr("disabled", false);
                $("#new_level_id").css("background-color", "#FFFF").css("cursor", "pointer");
            }
        });
    } else {
        $(".lds-ellipsis").remove();
        $("#new_level_id").attr("disabled", true);
        $("#new_level_id").css("background-color", "#e9e7e7").css("cursor", "not-allowed");
    }
}

</script>
@endpush

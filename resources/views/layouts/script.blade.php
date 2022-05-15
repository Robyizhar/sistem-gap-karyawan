<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<!-- Plugins js-->
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js" integrity="sha256-hw7v8jZF/rFEdx1ZHepT4D73AFTHLu/P9kEyrNesRyc=" crossorigin="anonymous"></script>
<!-- App js-->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
@include('sweetalert::alert')
@stack('script-datatable')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('script')
<script>
    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        let detele_url = $(this).attr("href");
        Swal.fire({
            title: 'Hapus data ini ?',
            text: "Anda tidak akan dapat memulihkan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
            }).then((result) => {
            if (result.isConfirmed) {
                $('.form-process').css('display', 'block');
                $.ajax({
                    type: "GET",
                    url: detele_url,
                    success: function (response) {
                        if (response == 'false') {
                            Swal.fire( 'Berhasil!', 'Data tidak dapat dihapus.', 'error' );
                            $('.form-process').css('display', 'none');
                        } else {
                            $('#state-saving-datatable').DataTable().ajax.reload();
                            $('.form-process').css('display', 'none');
                            Swal.fire( 'Berhasil!', 'Data berhail dihapus.', 'success' );
                        }
                    }
                });
            }
        })
    });
</script>

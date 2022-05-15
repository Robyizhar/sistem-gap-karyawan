@extends('layouts.main')
@push('style')

@endpush
@section('content')
    @component('layouts.component.datatable')
        @slot('action', route('pangkat.create'))
        @slot('content')
            <th width="12px;">No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th width="15%">Aksi</th>
        @endslot
    @endcomponent
@endsection
@push('script')
<script>
    $(document).ready( function () {
    let datatable = $('#state-saving-datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        method: "POST",
        sPaginationType: "full_numbers",
        ajax: {
            url: "{!! url('pangkat/get-data') !!}",
            type: "POST",
            dataType: "JSON"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'kode', name: 'kode'},
            {data: 'nama', name: 'nama'},
            {data: 'Action', name: 'Action'}
        ]
    });
});

</script>
@endpush

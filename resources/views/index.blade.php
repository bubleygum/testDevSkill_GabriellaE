<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Data Transaksi</h1>
        <div class="mb-3">
            <a href="{{ route('export.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('export.pdf') }}" class="btn btn-danger">Download PDF</a>
        </div>
        <h3>Data Transaksi</h3>
        <table class="table table-bordered" id="transaksi-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Toko Baru</th>
                    <th>Kode Toko Lama</th>
                    <th>Nominal Transaksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3 class="mt-5">Data Table A</h3>
        <div class="mb-4">
            <a href="{{ route('tambah.a') }}" class="btn btn-primary">Tambah Data A</a>
        </div>
        <a href="{{ route('table_a.export.pdf') }}" class="btn btn-warning mb-3">Download Table A PDF</a>
        <a href="{{ route('table_a.export') }}" class="btn btn-success mb-3">Download Table A Excel</a>
        <table class="table table-bordered" id="table-a">
            <thead>
                <tr>
                    <th>Kode Toko Baru</th>
                    <th>Kode Toko Lama</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3 class="mt-5">Data Table B</h3>
        <div class="mb-4">
            <a href="{{ route('tambah.b') }}" class="btn btn-primary">Tambah Data B</a>
        </div>
        <a href="{{ route('table_b.export.pdf') }}" class="btn btn-warning mb-3">Download Table B PDF</a>

        <a href="{{ route('table_b.export') }}" class="btn btn-success mb-3">Download Table B Excel</a>
        <table class="table table-bordered" id="table-b">
            <thead>
                <tr>
                    <th>Kode Toko</th>
                    <th>Nominal Transaksi</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3 class="mt-5">Data Table C</h3>
        <div class="mb-4">
            <a href="{{ route('tambah.c') }}" class="btn btn-primary">Tambah Data c</a>
        </div>
        <a href="{{ route('table_c.export.pdf') }}" class="btn btn-warning mb-3">Download Table C PDF</a>

        <a href="{{ route('table_c.export') }}" class="btn btn-success mb-3">Download Table C Excel</a>
        <table class="table table-bordered" id="table-c">
            <thead>
                <tr>
                    <th>Kode Toko</th>
                    <th>Area Sales</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3 class="mt-5">Data Table D</h3>
        <div class="mb-4">
            <a href="{{ route('tambah.d') }}" class="btn btn-primary">Tambah Data d</a>
        </div>
        <a href="{{ route('table_d.export.pdf') }}" class="btn btn-warning mb-3">Download Table D PDF</a>

        <a href="{{ route('table_d.export') }}" class="btn btn-success mb-3">Download Table D Excel</a>
        <table class="table table-bordered" id="table-d">
            <thead>
                <tr>
                    <th>Kode Sales</th>
                    <th>Nama Sales</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#transaksi-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('transaksi.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'kode_toko_baru', name: 'kode_toko_baru' },
                    { data: 'kode_toko_lama', name: 'kode_toko_lama' },
                    { data: 'nominal_transaksi', name: 'nominal_transaksi' }
                ]
            });

            $('#table-a').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('table_a.data') }}',
                columns: [
                    { data: 'kode_toko_baru', name: 'kode_toko_baru' },
                    { data: 'kode_toko_lama', name: 'kode_toko_lama' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-warning editBtn" data-id="' + row.id + '">Edit</button>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger deleteBtn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ]
            });

            $('#table-a tbody').on('click', '.editBtn', function () {
                var aId = $(this).data('id');
                window.location.href = '/edit-a/' + aId;
            });
            $('#table-a tbody').on('click', '.deleteBtn', function () {
                var aId = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/delete-a/' + aId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (result) {
                            $('#table-a').DataTable().ajax.reload();
                        }
                    });
                }
            });
            $('#table-b').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('table_b.data') }}',
                columns: [
                    { data: 'kode_toko', name: 'kode_toko' },
                    { data: 'nominal_transaksi', name: 'nominal_transaksi' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-warning editBtn" data-id="' + row.id + '">Edit</button>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger deleteBtn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ]
            });
            $('#table-b tbody').on('click', '.editBtn', function () {
                var bId = $(this).data('id');
                window.location.href = '/edit-b/' + aId;
            });
            $('#table-b tbody').on('click', '.deleteBtn', function () {
                var bId = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/delete-b/' + bId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (result) {
                            $('#table-b').DataTable().ajax.reload();
                        }
                    });
                }
            });
            $('#table-c').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('table_c.data') }}',
                columns: [
                    { data: 'kode_toko', name: 'kode_toko' },
                    { data: 'area_sales', name: 'area_sales' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-warning editBtn" data-id="' + row.id + '">Edit</button>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger deleteBtn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ]
            });
            $('#table-c tbody').on('click', '.editBtn', function () {
                var cId = $(this).data('id');
                window.location.href = '/edit-c/' + aId;
            });
            $('#table-c tbody').on('click', '.deleteBtn', function () {
                var cId = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/delete-c/' + cId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (result) {
                            $('#table-c').DataTable().ajax.reload();
                        }
                    });
                }
            });
            $('#table-d').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('table_d.data') }}',
                columns: [
                    { data: 'kode_sales', name: 'kode_sales' },
                    { data: 'nama_sales', name: 'nama_sales' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-warning editBtn" data-id="' + row.id + '">Edit</button>';
                        }
                    }, {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger deleteBtn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ]
            });
            $('#table-d tbody').on('click', '.editBtn', function () {
                var dId = $(this).data('id');
                window.location.href = '/edit-d/' + dId;
            });
            $('#table-d tbody').on('click', '.deleteBtn', function () {
                var dId = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/delete-d/' + dId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (result) {
                            $('#table-d').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
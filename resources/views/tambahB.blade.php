<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Manage Data Table B</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Manage Data for Table B</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form to insert new data -->
        <h4>Insert New Data</h4>
        <form action="{{ route('table_b.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_toko">Kode Toko</label>
                <input type="text" class="form-control" id="kode_toko" name="kode_toko" required>
            </div>
            <div class="form-group">
                <label for="nominal_transaksi">Nominal Transaksi</label>
                <input type="text" class="form-control" id="nominal_transaksi" name="nominal_transaksi" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Form to upload Excel file -->
        <form action="{{ route('table_b.storeExcel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Select Excel File</label>
                <input type="file" class="form-control-file" id="file" name="file" accept=".xlsx,.xls" required>
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>

        <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>
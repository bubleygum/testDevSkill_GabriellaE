<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data D</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data D</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('table_d.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_sales">Kode Sales</label>
                <input type="text" class="form-control" id="kode_sales" name="kode_sales" value="{{ $data->kode_sales }}" required>
            </div>
            <div class="form-group">
                <label for="nama_sales">Nama Sales</label>
                <input type="text" class="form-control" id="nama_sales" name="nama_sales" value="{{ $data->nama_sales }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('table_d.manage') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>

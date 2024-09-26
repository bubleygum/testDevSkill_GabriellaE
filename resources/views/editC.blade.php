<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data C</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data C</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('table_c.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_toko">Kode Toko </label>
                <input type="text" class="form-control" id="kode_toko" name="kode_toko" value="{{ $data->kode_toko }}" required>
            </div>
            <div class="form-group">
                <label for="area_sales">Area Sales</label>
                <input type="text" class="form-control" id="area_sales" name="area_sales" value="{{ $data->area_sales }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('table_c.manage') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>

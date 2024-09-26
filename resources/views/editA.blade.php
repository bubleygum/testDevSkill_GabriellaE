<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data A</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('table_a.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_toko_baru">Kode Toko Baru</label>
                <input type="text" class="form-control" id="kode_toko_baru" name="kode_toko_baru" value="{{ $data->kode_toko_baru }}" required>
            </div>
            <div class="form-group">
                <label for="kode_toko_lama">Kode Toko Lama</label>
                <input type="text" class="form-control" id="kode_toko_lama" name="kode_toko_lama" value="{{ $data->kode_toko_lama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('table_a.manage') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>

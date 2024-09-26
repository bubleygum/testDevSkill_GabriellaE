<!DOCTYPE html>
<html>
<head>
    <title>Table A Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Table A</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Toko Baru</th>
                <th>Kode Toko Lama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->kode_toko_baru }}</td>
                <td>{{ $row->kode_toko_lama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

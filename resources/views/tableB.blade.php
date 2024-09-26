<!DOCTYPE html>
<html>
<head>
    <title>Table B Data</title>
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
    <h2>Data Table B</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Toko </th>
                <th>Nominal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->kode_toko}}</td>
                <td>{{ $row->nominal_transaksi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Table D Data</title>
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
    <h2>Data Table D</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Sales</th>
                <th>Nama Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->kode_sales}}</td>
                <td>{{ $row->nama_sales}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

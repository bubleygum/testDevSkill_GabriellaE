<!DOCTYPE html>
<html>
<head>
    <title>Table C Data</title>
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
    <h2>Data Table C</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Toko</th>
                <th>Area Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->kode_toko }}</td>
                <td>{{ $row->area_sales}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

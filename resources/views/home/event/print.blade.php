<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .info-section {
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .info-section div {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Detail Acara :</h2>
    
  
    <table>
        <tr>
            <th>Judul Acara</th>
            <td>{{ $acara->judul }}</td>
        </tr>
        <tr>
            <th>Waktu Acara</th>
            <td>{{ \Carbon\Carbon::parse($acara->tgl_acara)->isoFormat('D MMMM Y') }} hingga {{ \Carbon\Carbon::parse($acara->wk_akhir)->format('h:i A') }}</td>
        </tr>
        <tr>
            <th>Reservasi Tutup Pada</th>
            <td>{{ \Carbon\Carbon::parse($acara->wk_res)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <th>Koordinator</th>
            <td>{{ $acara->User->name }}</td>
        </tr>
        <tr>
            <th>Tempat</th>
            <td>{{ $namaRuangString }}</td>
        </tr>
        <tr>
            <th>Deskripsi Acara</th>
            <td>{{ $acara->deskripsi }}</td>
        </tr>
        <tr>
            <th>Partisipan</th>
            <td>{{ $acara->participantCount }}</td>
        </tr>
    </table>


    
    <h2>Daftar Partisipan :</h2>

    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($partisipan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->User->name }}</td>
                    <td style="height: 40px;">
                        <!-- Area untuk tanda tangan -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

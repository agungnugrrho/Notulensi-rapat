<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Notulensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 10px 4px;
            text-align: center;
            vertical-align: middle;
        }
        .mb-2 {
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px 10px;
        }
        .signature img {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Notulensi {{ $notulen -> agenda }}</h1>

    <table class="info-table mb-2">
        <tr>
            <td width="150"><strong>Nama Kegiatan</strong></td>
            <td width="20">:</td>
            <td>{{ $notulen->agenda }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Kegiatan</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($notulen->dateInput)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Waktu Mulai</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($notulen->timeInput)->translatedFormat('H:i') }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th width="50">No.</th>
                <th width="130">Tanggal</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th width="40">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @if ($notulenDetail->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @else
                @foreach ($notulenDetail as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($detail->created_at)) }}</td>
                        <td>{{ $detail->nama }}</td>
                        <td>{{ $detail->jabatan }}</td>
                        <td class="signature">
                            @if ($detail->tanda_tangan)
                                @php
                                    $path = public_path('uploads/tanda_tangan/'.$detail->tanda_tangan);
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                @endphp
                                <img src="{{ $img }}" alt="TTD_ABSEN" style="max-width: 200px; max-height: 90px;">
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>

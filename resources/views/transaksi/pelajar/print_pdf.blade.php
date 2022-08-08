<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>SMK Pelita Persada</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tahun Ajaran</th>
                <th>Bulan</th>
                <th>Nama Pelajar</th>
                <th>Kelas</th>
                <th>Jumlah Tagihan</th>
                <th>Jumlah Dibayarkan</th>
                <th>Tunggakan</th>
                {{-- <th>Bukti Pembayaran</th> --}}
                <th>Tanggal Bayar</th>
                {{-- <th>Keterangan</th>
                <th>Status</th>
                <th>Bertanggung Jawab</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @php $i=1 @endphp --}}
            @foreach($transaksi as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->spp->tahun_ajaran }}/{{ $item->spp->tahun_ajaran+1 }}</td>
                <td>{{ $item->bulan }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->spp->kelas }}</td>
                <td>{{ $item->spp->total_tagihan }}</td>
                <td>{{ $item->jumlah_dibayarkan }}</td>
                <td>{{ $item->tunggakan }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

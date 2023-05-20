<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="print">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="cetak">
        <table class="printer">
            <tbody>
                <tr>
                    <td width="25%" class="bg-light">No Transaksi</td>
                    <td>{{ $header_transaksi->kode_transaksi }}</td>
                </tr>
                <tr>
                    <td class="bg-light">Tanggal Transaksi</td>
                    <td>{{ date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) }}</td>
                </tr>
                <tr>
                    <td class="bg-light">Nama Customer</td>
                    <td>{{ $header_transaksi->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <td class="bg-light">Email</td>
                    <td>{{ $header_transaksi->email }}</td>
                </tr>
                <tr>
                    <td class="bg-light">Telepon</td>
                    <td>{{ $header_transaksi->telepon }}</td>
                </tr>
                <tr>
                    <td class="bg-light">ALamat</td>
                    <td>{{ $header_transaksi->alamat }}</td>
                </tr>
                <tr>
                    <td class="bg-light">Total Transaksi</td>
                    <td>Rp. {{ number_format($header_transaksi->jumlah_transaksi) }}</td>
                </tr>
            </tbody>
        </table>
        {{-- produk --}}
        <br>
        <table class="printer">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Produk</td>
                    <td>Qty</td>
                    <td>Price</td>
                    <td>Sub Total</td>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($transaksi as $transaksi) { ?>
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $transaksi->nama_produk }}</td>
                    <td>{{ $transaksi->jumlah }}</td>
                    <td>{{ $transaksi->harga }}</td>
                    <td>{{ $transaksi->total_harga }}</td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<p class="text-right">
    <a href="{{ asset('admin/transaksi/cetak/'. $header_transaksi->id_header_transaksi) }}" class="btn btn-outline-danger" target="_blank">
        <i class="fa fa-file-pdf"></i> Cetak/Unduh</a>
    <a href="{{ asset('admin/transaksi/detail/'. $header_transaksi->id_header_transaksi) }}" class="btn btn-outline-success">
        <i class="fa fa-eye"></i> Detail</a>
    <a href="{{ asset('admin/transaksi') }}" class="btn btn-outline-info">
        <i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<form action="{{ asset('admin/transaksi/proses-edit') }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
{{ csrf_field() }}

<table class="table table-bordered table-sm">
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
            <td><input type="text" class="form-control" name="nama_pelanggan" required value="{{ $header_transaksi->nama_pelanggan }}"></td>
        </tr>
        <tr>
            <td class="bg-light">Email</td>
            <td><input type="text" class="form-control" name="email" required value="{{ $header_transaksi->email }}"></td>
        </tr>
        <tr>
            <td class="bg-light">Telepon</td>
            <td><input type="text" class="form-control" name="telepon" required value="{{ $header_transaksi->telepon }}"></td>
        </tr>
        <tr>
            <td class="bg-light">Alamat</td>
            <td><textarea name="alamat" class="form-control">{{ $header_transaksi->alamat }}</textarea></td>
        </tr>
        <tr>
            <td>Status Pembayaran</td>
            <td>
                <select name="status_bayar" class="form-control">
                    <option value="Sudah">Sudah</option>
                    <option value="Menunggu" <?php if($header_transaksi->status_bayar=='Menunggu') { echo 'selected'; } ?>>Menunggu</option>
                    <option value="Dibatalkan" <?php if($header_transaksi->status_bayar=='Dibatalkan') { echo 'selected'; } ?>>Dibatalkan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="bg-light">Total Transaksi</td>
            <td>Rp. {{ number_format($header_transaksi->jumlah_transaksi) }}</td>
        </tr>
    </tbody>
</table>
{{-- produk --}}
<table class="table table-bordered table-sm mt-3">
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
        <tr>
            <td colspan="2"></td>
            <td colspan="3">
                <button class="btn btn-success" name="submit" value="submit" type="submit">
                    <i class="fa fa-save"></i> Simpan & Update
                </button>
            </td>
        </tr>
    </tbody>
</table>

</form>
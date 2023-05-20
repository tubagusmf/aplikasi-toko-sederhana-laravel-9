@include('dasbor/menu')

{{-- error input --}}
@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="form-group">
    <div class="col-md-9">
        <form action="{{ asset('dasbor/proses-konfirmasi') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="form-group row mb-2">
                <label class="col-md-3">Pilih transaksi</label>
                <div class="col-md-9">
                    <select name="id_header_transaksi" class="form-control" required>
                        <?php foreach($header_transaksi as $header_transaksi) { ?>
                        <option value="<?php echo $header_transaksi->id_header_transaksi ?>">
                            <?php echo date('d-m-Y H:i:s', strtotime($header_transaksi->tanggal_transaksi)) ?> (<?php echo $header_transaksi->kode_transaksi ?> - Rp <?php echo number_format($header_transaksi->jumlah_transaksi) ?>)
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            
            <div class="form-group row mb-3">
                <label class="col-md-3">Jumlah Bayar</label>
                <div class="col-md-9">
                    <input type="number" class="form-control" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3">Tanggal Bayar</label>
                <div class="col-md-9">
                    <input type="date" class="form-control" name="tanggal_bayar" value="{{ old('tanggal_bayar') }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3">Bukti Bayar</label>
                <div class="col-md-9">
                    <input type="file" class="form-control" name="bukti_bayar" value="{{ old('bukti_bayar') }}">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <a href="{{ asset('keranjang') }}" class="btn btn-outline-info">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Simpan Konfirmasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('dasbor/footer')
                    
                
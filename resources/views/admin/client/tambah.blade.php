<script>
    function showUser(str) {
      if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","{{ asset('admin/client/provinsi') }}?q="+str,true);
        xmlhttp.send();
      }
    }
</script>

<p class="text-right">
    <a href="{{  asset('admin/client') }}" class="btn btn-outline-info btn-sm">
    <i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<form action="{{ asset('admin/client/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="form-group row">
    <label class="col-md-3">Nama Client</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="nama_client" value="{{ old('nama_client') }}" placeholder="Nama Client">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Status dan Jenis</label>
    <div class="col-md-2">
        <select name="status_client" class="form-control">
            <option value="Publish">Publish</option>
            <option value="Draft">Draft</option>
        </select>
        <small class="text-danger">Status CLient</small>
    </div>
    <div class="col-md-2">
        <select name="status_testimoni" class="form-control">
            <option value="Publish">Publish</option>
            <option value="Draft">Draft</option>
        </select>
        <small class="text-danger">Status Testimoni</small>
    </div>
    <div class="col-md-2">
        <select name="jenis_client" class="form-control">
            <option value="Perorangan">Perorangan</option>
            <option value="Perusahaan">Perusahaan</option>
            <option value="Organisasi">Organisasi</option>
        </select>
        <small class="text-danger">Jenis CLient</small>
    </div>
    <div class="col-md-2">
        <select name="status_baca" class="form-control">
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
        </select>
        <small class="text-danger">Status Baca</small>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Provinsi & Kabupaten</label>
    <div class="col-md-3">
        <select name="id_provinsi" class="form-control select2" onchange="showUser(this.value)" required>
            <option value="">Pilih Provinsi</option>
            <?php foreach($provinsi as $provinsi) { ?>
                <option value="<?php echo $provinsi->id_provinsi ?>"><?php echo $provinsi->nama_provinsi ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <div id="txtHint">
        <select name="id_kabupaten" class="form-control select2" required>
            <option value="">Pilih Kabupaten</option>
        </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Pimpinan</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="pimpinan" value="{{ old('pimpinan') }}" placeholder="Nama Pimpinan">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Alamat</label>
    <div class="col-md-9">
        <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Telepon & Website</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="telepon" value="{{ old('telepon') }}" placeholder="Telepon" required>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" name="website" value="{{ old('website') }}" placeholder="Website" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Tempat Tanggal Lahir</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control tanggal" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="dd-mm-yyyy" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Email & Password</label>
    <div class="col-md-3">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
    </div>
    <div class="col-md-3">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Detail Profile Client</label>
    <div class="col-md-9">
        <textarea name="isi" class="form-control" placeholder="Isi">{{ old('isi') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Isi Testimoni</label>
    <div class="col-md-9">
        <textarea name="isi_testimoni" class="form-control" placeholder="Isi Testimoni">{{ old('isi_testimoni') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Keywords</label>
    <div class="col-md-9">
        <textarea name="keywords" class="form-control" placeholder="Keywords">{{ old('keywords') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Gambar/Foto</label>
    <div class="col-md-9">
        <input type="file" class="form-control" name="gambar" value="{{ old('gambar') }}" placeholder="Gambar/Foto">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
        <a href="{{ asset('admin/client') }}" class="btn btn-outline-info">
            <i class="fa fa-arrow-left"></i>
        </a>
        <button class="btn btn-secondary" type="reset">
            <i class="fa fa-times"></i> Reset
        </button>
        <button class="btn btn-success" type="submit">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>
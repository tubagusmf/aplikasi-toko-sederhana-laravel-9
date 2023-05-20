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

<form action="{{ asset('admin/client/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="form-group row">
    <label class="col-md-3">Nama Client</label>
    <div class="col-md-9">
        <input type="hidden" class="form-control" name="id_client" value="{{ $client->id_client }}">
        <input type="text" class="form-control" name="nama_client" value="{{ $client->nama_client }}" placeholder="Nama Client">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Status dan Jenis</label>
    <div class="col-md-2">
        <select name="status_client" class="form-control">
            <option value="Publish">Publish</option>
            <option value="Draft" <?php if($client->status_client=="Draft") { echo 'selected'; }?>>Draft</option>
        </select>
        <small class="text-danger">Status CLient</small>
    </div>
    <div class="col-md-2">
        <select name="status_testimoni" class="form-control">
            <option value="Publish">Publish</option>
            <option value="Draft" <?php if($client->status_testimoni=="Draft") { echo 'selected'; }?>>Draft</option>
        </select>
        <small class="text-danger">Status Testimoni</small>
    </div>
    <div class="col-md-2">
        <select name="jenis_client" class="form-control">
            <option value="Perorangan">Perorangan</option>
            <option value="Perusahaan" <?php if($client->jenis_client=="Perusahaan") { echo 'selected'; }?>>Perusahaan</option>
            <option value="Organisasi" <?php if($client->jenis_client=="Organisasi") { echo 'selected'; }?>>Organisasi</option>
        </select>
        <small class="text-danger">Jenis CLient</small>
    </div>
    <div class="col-md-2">
        <select name="status_baca" class="form-control">
            <option value="Sudah">Sudah</option>
            <option value="Belum" <?php if($client->status_baca=="Belum") { echo 'selected'; }?>>Belum</option>
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
                <option value="<?php echo $provinsi->id_provinsi ?>" <?php if($client->id_provinsi==$provinsi->id_provinsi) { echo 'selected'; }?>><?php echo $provinsi->nama_provinsi ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <div id="txtHint">
        <select name="id_kabupaten" class="form-control select2" required>
            <option value="{{ $client->id_kabupaten }}">{{ $client->nama_kabupaten }}</option>
        </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Pimpinan</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="pimpinan" value="{{ $client->pimpinan }}" placeholder="Nama Pimpinan">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Alamat</label>
    <div class="col-md-9">
        <textarea name="alamat" class="form-control" placeholder="Alamat">{{ $client->alamat }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Telepon & Website</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="telepon" value="{{ $client->telepon }}" placeholder="Telepon" required>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" name="website" value="{{ $client->website }}" placeholder="Website" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Tempat Tanggal Lahir</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="tempat_lahir" value="{{ $client->tempat_lahir }}" required>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control tanggal" name="tanggal_lahir" value="{{ date('d-m-Y', strtotime($client->tanggal_lahir)) }}" placeholder="dd-mm-yyyy" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Email & Password</label>
    <div class="col-md-9">
        <input type="email" class="form-control" name="email" value="{{ $client->email }}" placeholder="Email" required>
    </div>
    {{-- <div class="col-md-3">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
    </div> --}}
</div>
<div class="form-group row">
    <label class="col-md-3">Detail Profile Client</label>
    <div class="col-md-9">
        <textarea name="isi" class="form-control" placeholder="Isi">{{ $client->isi }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Isi Testimoni</label>
    <div class="col-md-9">
        <textarea name="isi_testimoni" class="form-control" placeholder="Isi Testimoni">{{ $client->isi_testimoni }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Keywords</label>
    <div class="col-md-9">
        <textarea name="keywords" class="form-control" placeholder="Keywords">{{ $client->keywords }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Gambar/Foto</label>
    <div class="col-md-9">
        <input type="file" class="form-control" name="gambar" value="{{ $client->gambar }}" placeholder="Gambar/Foto">
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
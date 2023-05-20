<p class="text-right">
    <a href="{{  asset('admin/kabupaten') }}" class="btn btn-outline-info btn-sm">
    <i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<form action="{{ asset('admin/kabupaten/proses-tambah') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="form-group row">
    <label class="col-md-3">ID Kabupaten</label>
    <div class="col-md-9">
        <input type="number" class="form-control" name="id_kabupaten" value="{{ old('id_kabupaten') }}" placeholder="ID Kabupaten" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Nama Kabupaten</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="nama_kabupaten" value="{{ old('nama_kabupaten') }}" placeholder="Nama" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Provinsi & Status</label>
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
        <select name="aktif" class="form-control">
            <option>Status Kabupaten</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Latitude</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" placeholder="Latitude">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Longitude</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" placeholder="Longitude">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Keterangan</label>
    <div class="col-md-9">
        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Json Data</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="json_data" value="{{ old('json_data') }}" placeholder="Json Data">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Coordinates</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="coordinates" value="{{ old('coordinates') }}" placeholder="Coordinates">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
        <a href="{{ asset('admin/kabupaten') }}" class="btn btn-outline-info">
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
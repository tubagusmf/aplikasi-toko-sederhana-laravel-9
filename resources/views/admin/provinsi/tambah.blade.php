<p class="text-right">
    <a href="{{  asset('admin/provinsi') }}" class="btn btn-outline-info btn-sm">
    <i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<form action="{{ asset('admin/provinsi/proses-tambah') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="form-group row">
    <label class="col-md-3">ID Provinsi</label>
    <div class="col-md-9">
        <input type="number" class="form-control" name="id_provinsi" value="{{ old('id_provinsi') }}" placeholder="ID Provinsi" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Nama Provinsi</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="nama_provinsi" value="{{ old('nama_provinsi') }}" placeholder="Nama" required>
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
    <label class="col-md-3">Kode Provinsi</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="kode_provinsi" value="{{ old('kode_provinsi') }}" placeholder="Kode Provinsi">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Kode Highmap</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="kode_highmap" value="{{ old('kode_highmap') }}" placeholder="Kode Highmap">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Nama Highmap</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="name_highmap" value="{{ old('name_highmap') }}" placeholder="Nama Highmap">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Nomor Highmap</label>
    <div class="col-md-9">
        <input type="number" class="form-control" name="nomor_highmap" value="{{ old('nomor_highmap') }}" placeholder="Nomor Highmap">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Status</label>
    <div class="col-md-9">
        <select name="aktif" class="form-control">
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
        <span class="text-danger">Status Aktif = 1 | Status Nonaktif = 0</span>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
        <a href="{{ asset('admin/provinsi') }}" class="btn btn-outline-info">
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
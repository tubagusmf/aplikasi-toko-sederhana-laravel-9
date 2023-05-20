

<form action="{{ asset('admin/kabupaten/proses') }}" method="post">
    {{ csrf_field() }}
<div class="mailbox-controls">
    <div class="table-responsive mailbox-messages">

        <div class="input-group input-group-sm">
            <button type="submit" name="hapus" class="btn btn-secondary btn-sm">
                <i class="fa fa-trash"></i>
            </button>
            <select name="aktif" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
            <span class="input-group-append">
              <button type="submit" name="update" class="btn btn-info btn-sm">Update</button>
              <a href="{{ asset('admin/kabupaten/tambah') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus-circle"></i> Tambah Baru </a>
            </span>
        </div>
        <br>

        <table class="table table-bordered table-sm" id="example1">
            <thead>
                <tr>
                    <th width="5%">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                    </th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Provinsi</th>
                    <th>Keterangan</th>
                    <th>Latitude</th>
                    <th>Longtitude</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($kabupaten as $kabupaten) { ?>
                <tr>
                    <td class="text-center">
                        <div class="icheck-primary">
                            <input type="checkbox" name="id_kabupaten[]" value="{{ $kabupaten->id_kabupaten }}" id="check{{ $i }}">
                            <label for="check{{ $i }}"></label>
                        </div>
                    </td>
                    <td>{{ $kabupaten->nama_kabupaten }}</td>
                    <td>{{ $kabupaten->nama_provinsi }}</td>
                    <td>{{ $kabupaten->keterangan }}</td>
                    <td>{{ $kabupaten->latitude }}</td>
                    <td>{{ $kabupaten->longitude }}</td>
                    <td>{{ $kabupaten->aktif }}</td>
                    <td>
                        <a href="{{ asset('admin/kabupaten/edit/'. $kabupaten->id_kabupaten) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ asset('admin/kabupaten/delete/'. $kabupaten->id_kabupaten) }}" class="btn btn-secondary btn-sm delete-link"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</form>
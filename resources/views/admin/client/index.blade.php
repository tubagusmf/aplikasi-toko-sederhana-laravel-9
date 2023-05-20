

<form action="{{ asset('admin/client/proses') }}" method="post">
    {{ csrf_field() }}
<div class="mailbox-controls">
    <div class="table-responsive mailbox-messages">

        <div class="input-group input-group-sm">
            <button type="submit" name="hapus" class="btn btn-secondary btn-sm">
                <i class="fa fa-trash"></i>
            </button>
            <select name="id_provinsi" class="form-control">
                <?php foreach($provinsi as $provinsi) { ?>
                <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</option>
                <?php } ?>
            </select>
            <span class="input-group-append">
              <button type="submit" name="update" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Update</button>
              <button type="submit" name="draft" class="btn btn-secondary btn-sm" title="Set Sabagai Draft"><i class="fa fa-eye-slash"></i></button>
              <button type="submit" name="publish" class="btn btn-dark btn-sm" title="Publikasikan"><i class="fa fa-eye"></i></button>
                <a href="{{ asset('admin/client/tambah') }}" class="btn btn-success btn-sm">
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
                    <th width="10%">Gambar</th>
                    <th>Client</th>
                    <th>Provinsi</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($client as $client) { ?>
                <tr>
                    <td class="text-center">
                        <div class="icheck-primary">
                            <input type="checkbox" name="id_client[]" value="{{ $client->id_client }}" id="check{{ $i }}">
                            <label for="check{{ $i }}"></label>
                        </div>
                    </td>
                    <td>
                        <?php if($client->gambar == '') { echo '-'; } else { ?>
                        <img src="{{ asset('assets/upload/image/'. $client->gambar) }}" class="img img-thumbnail">
                        <?php } ?>
                    </td>
                    <td>{{ $client->nama_client }}</td>
                    <td><a href="{{ asset('admin/client/provinsi/'.$client->id_provinsi) }}">{{ $client->nama_provinsi }}</a></td>
                    <td>{{ $client->jenis_client }}</td>
                    <td class="text-center">
                        <a href="{{ asset('admin/client/status-client/'.$client->status_client) }}">
                            <?php if($client->status_client=='Draft') { ?>
                                <span class="badge badge-secondary"><i class="fa fa-eye-slash"></i>
                                    {{ $client->status_client }}
                                </span>
                            <?php }else{ ?>
                                <span class="badge badge-dark"><i class="fa fa-eye"></i>
                                    {{ $client->status_client }}
                                </span>
                            <?php } ?>
                        </a>
                    </td>
                    <td>
                        <a href="{{ asset('client/'. $client->id_client) }}" class="btn btn-success btn-sm mb-1" target="_blank"><i class="fa fa-eye"></i></a>

                        <a href="{{ asset('admin/client/cetak/'. $client->id_client) }}" class="btn btn-danger btn-sm mb-1" target="_blank"><i class="fa fa-file-pdf"></i></a>

                        <a href="{{ asset('admin/client/edit/'. $client->id_client) }}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-edit"></i></a>

                        <a href="{{ asset('admin/client/delete/'. $client->id_client) }}" class="btn btn-secondary btn-sm delete-link mb-1"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</form>
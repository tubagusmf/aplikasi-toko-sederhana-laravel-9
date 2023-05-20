<select name="id_kabupaten" class="form-control select2">
    <option value="">Pilih Kabupaten</option>
    <?php foreach($kabupaten as $kabupaten) { ?>
        <option value="<?php echo $kabupaten->id_kabupaten ?>"><?php echo $kabupaten->nama_kabupaten ?></option>
    <?php } ?>
</select>
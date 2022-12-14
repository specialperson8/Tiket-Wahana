<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Edit Destinasi | Admin
        </div>
        <div class="card-body">

          <?= form_open_multipart() ?>
          <?= $this->session->flashdata('message') ?>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Wahana</label>
            <input type="text" name="nama_wahana" value="<?= $detail->nama_wahana ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Destinasi" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Destinasi</label>
            <select name="id_destinasi" class="form-control" required>
              <option value="">Pilih Destinasi</option>
              <?php
              foreach ($destinasi as $k) {
                if ($k->id_destinasi == $detail->id_destinasi) {
                  $selected = ' selected';
                } else {
                  $selected = '';
                }
                echo '<option value="' . $k->id_destinasi . '"' . $selected . '>' . $k->nama_destinasi . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Orang</label>
            <input type="number" name="harga" value="<?= $detail->harga ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Hari" required>
          </div>
          <!-- <div class="form-group">
            <label for="exampleInputEmail1">Harga per 2-5 Orang</label>
            <input type="number" name="harga_bulan" value="<?= $detail->harga_bulan ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Bulan" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per 5-10 Orang</label>
            <input type="number" name="harga_tahun" value="<?= $detail->harga_tahun ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Tahun" required>
          </div>-->
          <div class="form-group">
            <label for="exampleInputEmail1">Foto</label>
            <small class="text-bold">*File yang diizinkan : jpg,png,jpeg</small>
            <br><img class="img-thumbnail" style="width: 200px" src="<?= base_url('assets/images/apartement') . "/" . $detail->foto ?>"><br><br>
            <input type="file" name="foto">
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
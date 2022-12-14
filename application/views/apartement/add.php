<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Tambah Destinasi | Admin
        </div>
        <div class="card-body">

          <?= form_open_multipart() ?>
          <?= $this->session->flashdata('message') ?>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Destinasi</label>
            <input type="text" name="nama_wahana" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Wahana" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Destinasi</label>
            <select name="id_destinasi" class="form-control" required>
              <option value="">Pilih Destinasi</option>
              <?php
              foreach ($destinasi as $k) {
                echo '<option value="' . $k->id_destinasi . '">' . $k->nama_destinasi . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Orang</label>
            <input type="number" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Orang" required>
          </div>
          <!--   <div class="form-group">
            <label for="exampleInputEmail1">Harga per Bulan</label>
            <input type="number" name="harga_bulan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Bulan" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Tahun</label>
            <input type="number" name="harga_tahun" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Tahun" required>
          </div>-->
          <div class="form-group">
            <label for="exampleInputEmail1">Foto</label>
            <small class="text-bold">*File yang diizinkan : jpg,png,jpeg</small><br>
            <input type="file" name="foto" required>
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
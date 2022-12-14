<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <span class="text-purple text-bold">Destinasi</span><br>
              <?= $detail->nama_destinasi ?>
            </div>
            <div class="col-md-3">
              <span class="text-purple text-bold">Nama Wahana</span><br>
              <?= $detail->nama_wahana ?>
            </div>
            <div class="col-md-6">
              <span class="text-purple text-bold">Harga per Orang</span><br>
              <?= rupiah($detail->harga) ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Form Pemesanan Wahana
        </div>
        <div class="card-body">
          <?= form_open('order/processOrder/' . $detail->id_tiket) ?>
          <?= $this->session->flashdata('message') ?>
          <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <select name="paket" id="sPaket" onchange="tJumlah()" class="form-control" required>
              <option value="">Pencet menu dibawah</option>
              <?php
              $paket = array('orang');
              foreach ($paket as $p) {
                echo '<option value="' . $p . '">' . ucwords($p) . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group" id="divJumlah" style="display: none">
            <label for="exampleInputPassword1" id="lJumlah">Jumlah</label>
            <input type="text" name="jumlah_paket" class="form-control" onchange="countCheckOut()" id="iJumlah" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Booking</label>
            <input type="date" name="tgl_booking" onchange="countCheckOut()" class="form-control" id="tgl_booking" placeholder="Pilih Tanggal Booking" required>
          </div>
          <!--  <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Checkout</label>
            <p class="text-purple" id="tCheckOut" style="font-weight: 500">-</p>
          </div>-->
          <div class="form-group">
            <label for="exampleInputPassword1">Total Bayar</label><br>
            <p class="badge badge-primary" id="pHarga" style="font-size: 30px;font-weight: 300">Rp. 0,-</p>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Jenis Pembayaran</label>
            <select name="jenis_pembayaran" class="form-control" required>
              <option value="">Pilih Jenis Pembayaran</option>
              <?php
              $jenis_pembayaran = array('cash', 'transfer');
              foreach ($jenis_pembayaran as $p) {
                echo '<option value="' . $p . '">' . ucwords($p) . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Bayar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function tJumlah() {
    var paket = $('#sPaket').val();
    var npaket;
    if (paket !== '') {
      if (paket == 'orang') {
        npaket = 'Orang';
      } else if (paket == 'orang') {

      }
      $('#lJumlah').html('Jumlah ' + npaket);
      $('#iJumlah').prop('placeholder', 'Masukan Jumlah ' + npaket);
      $('#divJumlah').show();
    } else {
      $('#divJumlah').hide();
    }
    countCheckOut();
  }

  function countCheckOut() {
    var paket = $('#sPaket').val();
    var jumlah = $('#iJumlah').val();
    var tgl_booking = $('#tgl_booking').val();
    var day;
    if (paket !== '' && jumlah !== '' && tgl_booking !== '') {
      if (paket == 'orang') {
        day = 1;
      } else if (paket == 'orang') {

      }
      var days = jumlah * day;

      var myDate = new Date(tgl_booking);

      var newDate = addDays(myDate, days);
      $('#tCheckOut').html(tanggalIndo(newDate));
    }
    countBayar();
  }

  function countBayar() {
    var paket = $('#sPaket').val();
    var jumlah = $('#iJumlah').val();
    var harga;
    if (paket !== '' && jumlah !== '') {
      if (paket == 'orang') {
        harga = <?= $detail->harga ?>;
      } else if (paket == 'orang') {
        harga = <?= $detail->harga ?>;
      }
      var total = jumlah * harga;
      $('#pHarga').html(rupiah(total));
    }

  }
</script>
<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Pesanan Saya
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Booking</th>
                <th scope="col">Tgl Booking</th>
                <th scope="col">Destinasi</th>
                <th scope="col">Paket</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Detail</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $i = 1;
              foreach ($list as $l) {
                if ($l->paket == 'orang') {
                  $paket = 'orang';
                } elseif ($l->paket == 'orang') {
                }
              ?>
                <tr>
                  <th scope="row"><?= $i ?></th>
                  <th scope="row"><?= $l->kode_booking ?></th>
                  <td><?= tanggal($l->tgl_booking) ?></td>
                  <td><?= $l->nama_wahana ?></td>
                  <td><?= $l->jumlah_paket ?> Orang</td>
                  <td><?= rupiah($l->total_bayar) ?></td>
                  <td><?= status_pembayaran($l->status_pembayaran) ?></td>
                  <td><a href="<?= base_url('order/detail/' . $l->id_transaksi) ?>" class="btn btn-primary">Detail</a></td>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
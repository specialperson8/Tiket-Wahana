<div class="container" style="margin-top: 30px;">

</div>
<hr>
<div class="row">
	<?php
	$i = 1;
	if (empty($list)) {
		echo "<div class='col-md-12'><center><h2>Data tidak ditemukan</h2></center></div>";
	} else {
		foreach ($list as $l) {
	?>
			<div class="col-md-4" style="margin-bottom: 20px;">
				<div class="card">
					<div class="gambar">
						<img src="<?= base_url('assets/images/apartement') . "/" . $l->foto ?>" class="card-img-top">
					</div>
					<div class="card-body">
						<h5 class="card-title text-purple"><?= $l->nama_wahana ?></h5>
						<p class="card-text"><small>Mulai dari</small><br><?= rupiah($l->harga) ?> / Orang <span class="text-bold float-right"><?= $l->nama_destinasi ?></span></p>
						<a href="<?= base_url('order/make/' . $l->id_tiket) ?>" class="btn btn-block btn-primary">Pesan</a>
					</div>
				</div>
			</div>
	<?php $i++;
		}
	} ?>
</div>
</div>
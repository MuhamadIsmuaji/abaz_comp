<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
			<h2> Detail Transaksi</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<div class="table-responsvie">
					<table class="table table-stripped">
						<tr>
							<td>No Nota</td>
							<td>:</td>
							<td><?= $transaksi->no_nota ?></td>
						</tr>
						<tr>
							<td>Nama Pembeli</td>
							<td>:</td>
							<td><?= $transaksi->nama_pembeli ?></td>							
						</tr>
						<tr>
							<td>Tanggal Pembelian</td>
							<td>:</td>
							<?php $tgl_pembelian = new DateTime($transaksi->tgl_pembelian); ?>
							<td><?= $tgl_pembelian->format('d-m-Y') ?></td>
						</tr>
						<tr>
							<td>Operator</td>
							<td>:</td>
							<td><?= $transaksi->operator ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="well">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Harga Satuan (Rp)</th>
								<th>Jumlah Harga (Rp)</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($detailTransaksi as $detail) {									
							?>
							<tr>
								<td><?= $detail->kode_barang ?></td>
								<td><?= $detail->nama_barang ?></td>
								<td><?= $detail->jumlah ?></td>
								<td><?= $detail->harga_satuan ?></td>
								<td><?= $detail->jumlah_harga ?></td>
							</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-8">
						<h3>
							<strong>
								Total Pembelian : <?= $transaksi->total_pembelian ?>
							</strong>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3" align="center">
			<h2> Tambah Barang</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="well">
				<form action="<?= base_url('admin/barang/insert') ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputtext1">Kode Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Kode Barang" name="kode_barang" required>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Nama Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Nama Barang" name="nama_barang" required>
					</div>
					<div class="form-group">
						<label for="inputPassword3">Stock Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Stok Barang" name="stock_barang" required>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Harga Beli (Rp)</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Harga Beli" name="harga_beli" required>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Harga Jual (Rp)</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Harga Jual" name="harga_jual" required>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Diskon (%)</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Diskon" name="diskon">
					</div>
					<div class="form-group">
						<label for="inputPassword3">Kategori</label>
						<select name="katagori" class="form-control" placeholder="katagori">
							<?php 
								foreach ($katagori as $kat) {
							?>
								<option value="<?= $kat->id_kategori ?>"  >
									<?= $kat->nama_kategori ?>
								</option>
							
							<?php 
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Gambar Barang</label>
						<input type="file" class="form-control" id="exampleInputtext1" placeholder="Gambar" name="gambar">
					</div>
					<button type="submit" class="btn btn-success btn-block">
						<strong>Tambah</strong>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
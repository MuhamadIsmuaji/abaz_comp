<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3" align="center">
			<h2>Edit Barang</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="well">
				<form action="<?= base_url('admin/barang/updateProcess') ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputtext1">Kode Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Kode Barang" name="kode_barang" value="<?= $barang->kode_barang ?>">
						<input type="hidden" class="form-control" id="exampleInputtext1" placeholder="Kode Barang" name="kode_barang_cek" value="<?= $barang->kode_barang ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Nama Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Nama Barang" name="nama_barang" value="<?= $barang->nama_barang ?>">
					</div>
					<div class="form-group">
						<label for="inputPassword3">Stock Barang</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Stok Barang" name="stock_barang" required value="<?= $barang->stock_barang ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Harga Beli</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Harga Beli" name="harga_beli" value="<?= $barang->harga_beli ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Harga Jual</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Harga Jual" name="harga_jual" value="<?= $barang->harga_jual ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Diskon</label>
						<input type="text" class="form-control" id="exampleInputtext1" placeholder="Diskon" name="diskon" value="<?= $barang->diskon ?>">
					</div>
					<div class="form-group">
						<label for="inputPassword3">Kategori</label>
						<select name="kategori" class="form-control">
							<?php 
								foreach ($katagori as $kat) {
									if ( $kat->id_kategori	== $barang->katagori ) {
										$select = 'selected';
									} else {
										$select = '';
									}
							?>
								<option value="<?= $kat->id_kategori ?>"  <?= $select ?> >
									<?= $kat->nama_kategori ?>
								</option>
							
							<?php 
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputtext1">Ganti Gambar Barang</label>
						<input type="file" class="form-control" id="exampleInputtext1" placeholder="Gambar" name="gambar" >
					</div>
					<button type="submit" class="btn btn-success btn-block">
						<strong>Update</strong>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>


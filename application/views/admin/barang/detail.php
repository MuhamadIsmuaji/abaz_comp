<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" align="center">
		<h2>Detail Barang</h2>           
		<img height="25%" width="25%" src="<?= base_url('assets/img/produk/'.$barang->gambar)?>" class="img-thumbnail">
		<table class="table">
			<thead>
				<tr>
					<td><strong>Nama Barang</strong></td>
					<td align="center"><?= $barang->nama_barang ?></td>
				</tr>
				<tr>
					<td><strong>Stock Barang</strong></td>
					<td align="center"><?= $barang->stock_barang ?></td>
				</tr>
				<tr>
					<td><strong>Harga Beli</strong></td>
					<td align="center"><?= $barang->harga_beli ?></td>
				</tr>
				<tr>
					<td><strong>Harga Jual</strong></td>
					<td align="center"><?= $barang->harga_jual ?></td>
				</tr>
				<tr>
					<td><strong>Diskon</strong></td>
					<td align="center"><?= $barang->diskon ?></td>
				</tr>
				<tr>
					<td><strong>Kategori</strong></td>
					<td align="center"><?= $barang->nama_kategori ?></td>
				</tr>
			</thead>
		</table>
		<h1><button href="daftar_barang.php" class="btn-warning">Keluar</button></h1><br><br><br>
	</div>
</body>
</html>



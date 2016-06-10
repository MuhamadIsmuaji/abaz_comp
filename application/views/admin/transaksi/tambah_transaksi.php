<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="well">
				<h5 style="text-align: center;">
					<strong>Form Transaksi</strong>
				</h5>
				<hr>
				<form id="formTransaksi" action="#" method="#">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputtext1">No Nota</label>
							<input type="text" class="form-control" id="no_nota" name="no_nota" value="<?= $notaMax ?>" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputtext1">Nama Barang</label>
							<input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" name="nama_barang" required>
							<input type="hidden" class="form-control" id="kode_barang" name="kode_barang">
							<input type="hidden" class="form-control" id="operator" value="<?= $this->session->userdata('username')?>">

						</div>
						<div class="form-group">
							<label for="exampleInputtext1">Harga Satuan (Rp)</label>
							<input type="text" class="form-control" id="harga_satuan" placeholder="0" name="harga_satuan" readonly>
						</div>
						<div class="form-group">
							<label for="exampleInputtext1">Diskon (%)</label>
							<input type="text" class="form-control" id="diskon" placeholder="0" name="diskon" readonly>
						</div>
						<div class="form-group">
							<label for="exampleInputtext1">Harga Diskon (Rp)</label>
							<input type="text" class="form-control" id="harga_diskon" placeholder="0" name="harga_diskon" readonly>
						</div>
						<div class="form-group">
							<label for="exampleInputtext1">Banyaknya</label>
							<input type="text" class="form-control" id="banyaknya" placeholder="0" name="banyaknya" required>
						</div>
						<div class="form-group">
							<label for="exampleInputtext1">Jumlah Harga (Rp)</label>
							<input type="text" class="form-control" id="jumlah_harga" placeholder="0" name="jumlah_harga" readonly>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-success btn-block" onclick="tambahTransaksi();">
								<strong>Tambah Transaksi</strong>
							</button>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-warning btn-block" onclick="resetForm();">
								<strong>Reset Form</strong>
							</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="well">
				<h5 style="text-align: center;">
					<strong>Daftar Pembelian Barang</strong>
				</h5>
				<hr>
				<div class="table-responsive">
					<table id="tbDaftarPerTransaksi" class="table table-striped">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Banyaknya</th>
								<th>Harga Satuan (Rp)</th>
								<th>Jumlah Harga (Rp)</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach ($detailTransaksi as $value) {
						?>
							<tr>
								<td><?= $value->kode_barang ?></td>
								<td><?= $value->nama_barang ?></td>
								<td><?= $value->jumlah ?></td>
								<td><?= $value->harga_satuan ?></td>
								<td><?= $value->jumlah_harga ?></td>
							</tr>
						<?php 
							}
						?>
						</tbody>
					</table>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4 col-md-offset-8">
						<div class="form-group">
							<label for="exampleInputtext1">Total Harga (Rp)</label>
							<input type="text" class="form-control" id="total_harga" value="<?= $total_pembelian ?>" name="total_harga" placeholder="0" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-block" onclick="tampil_konfirmasi()">
							<strong>Simpan Transaksi</strong>
						</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-danger btn-block">
							<strong>Hapus Transaksi</strong>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/transaksi/konfirmasi_transaksi'); ?>

<script type="text/javascript">
	$(function(){
		
		
		//datepicker
        $('#tgl_pembelian').datetimepicker({
            format:'DD-MM-YYYY'
        });
		//datepicker

		getBarangAutocomplete();
		keyupBanyaknya();
		focusOutBanyaknya();

		// simpan transaksi
		$('#simpan_transaksi').on('click',function(){
			no_nota = $('#no_nota').val();
			tgl_pembelian = $('#tgl_pembelian').val();
			nama_pembeli = $('#nama_pembeli').val();
			total_harga = $('#total_harga').val();

			$.ajax({
				url : "<?= base_url('admin/transaksi/simpanTransaksi') ?>",
				method : "POST",
				data : 'no_nota='+no_nota+'&tgl_pembelian='+tgl_pembelian+'&nama_pembeli='+nama_pembeli+'&total_harga='+total_harga,
				dataType : 'JSON',
				success : function(msg) {
					if ( msg == 0 ) {
						pesan = 'Simpan Transaksi Berhasil';
					} else {
						pesan = 'Simpan Transaksi Gagal';
					}

					alert(pesan);
					window.location.href="<?= base_url('admin/transaksi') ?>";
				}

			});
		});
		// simpan transaksi

	});

	// tampil konfirmasi
	function tampil_konfirmasi() {
		$('#konfirmasi_transaksi').modal('show');
	}
	// tampil konfirmasi

	//getBarangAutocomplete
	function getBarangAutocomplete() {
		$('#nama_barang').autocomplete({
			minlength : 2,
			source : "<?= base_url('admin/transaksi/getBarangAutocomplete') ?>",
			focus : function(event,ui) {
				$('#nama_barang').val(ui.item.value);
				return false;
			},
			select : function(event,ui) {
				$('#kode_barang').val(ui.item.label);
				$('#nama_barang').val(ui.item.value);
				$('#harga_satuan').val(ui.item.harga_jual);
				$('#diskon').val(ui.item.diskon);
				
				diskon = (parseFloat($('#diskon').val()) / 100) * parseFloat($('#harga_satuan').val());
				harga_diskon = parseFloat($('#harga_satuan').val()) - diskon;

				$('#harga_diskon').val(harga_diskon);
				$('#banyaknya').val('0');

			}
		})
		.autocomplete( "instance" )._renderItem = function( ul, item ) {
	      return $( "<li>" )
	        .append( "<a><h4>" + item.value + "</h4></a>" )
	        .appendTo( ul );
	    };
	}
	//getBarangAutocomplete
	

	// keyup banyaknya
	function keyupBanyaknya() {
		$('#banyaknya').on('keyup',function(){
			
			if ( $(this).val() == '' ) {
				banyaknya = 0;
			} else {
				banyaknya = parseFloat($(this).val());
			}

			harga_diskon = parseFloat($('#harga_diskon').val());

			$('#jumlah_harga').val(harga_diskon * banyaknya);
		});
	}
	// keyup banyaknya

	// focusout banyanya
	function focusOutBanyaknya() {
		$('#banyaknya').on('focusout',function(){
			if ( $(this).val() == '' ) {
				banyaknya = 0;
			} else {
				banyaknya = parseFloat($(this).val());
			}

			harga_diskon = parseFloat($('#harga_diskon').val());

			$('#jumlah_harga').val(harga_diskon * banyaknya);
		});
	}
	// focusout banyanya
	
	// resetForm
	function resetForm() {
		$('#nama_barang').val('');
		$('#kode_barang').val('');
		$('#harga_satuan').val('');
		$('#diskon').val('');
		$('#harga_diskon').val('');
		$('#banyaknya').val('');
		$('#jumlah_harga').val('');
	} 
	// resetForm
	
	// tambahTransaksi
	function tambahTransaksi(){
		no_nota = $('#no_nota').val();
		//tgl_pembelian = $('#tgl_pembelian').val();
		//nama_pembeli = $('#nama_pembeli').val();
		total_harga = 0;
		operator = $('#operator').val();
		kode_barang = $('#kode_barang').val();
		jumlah = $('#banyaknya').val();
		harga_satuan = $('#harga_diskon').val();

		jumlah_harga = parseFloat(harga_satuan) * parseFloat(jumlah);

		$.ajax({
			url : "<?= base_url('admin/transaksi/tambahTransaksiProses') ?>",
			data : 'no_nota='+no_nota+'&total_harga='+total_harga+'&operator='+operator+'&kode_barang='+kode_barang+'&jumlah='+jumlah+'&harga_satuan='+harga_satuan+'&jumlah_harga='+jumlah_harga,
			method : 'POST',
			dataType : 'json',
			success : function(msg) {
				if ( msg == 1 ) {
					alert('Stok Barang Tidak Memadahi');
				}

				window.location.href="<?= base_url('admin/transaksi/tambahTransaksi') ?>/"+no_nota;
			}
		})
	}
	// tambahTransaksi
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
			<h2> Daftar Transaksi</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<a href="<?= base_url('admin/transaksi/tambahTransaksi/'.$noNotaMax) ?>" class="btn btn-primary">
					<strong>Tambah Transaksi</strong>
				</a>
			</div>
		</div>

		<div class="col-md-12">
			<div class="well">
				<form action="<?= base_url('admin/transaksi/cetakLaporan') ?>" method="POST">
				<div class="row">
					<div class="col-md-2 col-md-offset-4">
						<div class="form-group">
							<label for="exampleInputtext1">Dari Tanggal</label>
							<input type="text" class="form-control" id="dari" name="dari" required />
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputtext1">Sampai Tanggal</label>
							<input type="text" class="form-control" id="sampai" name="sampai" required/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" class="btn btn-success btn-block">
							<strong>Cetak Laporan Transaksi</strong>
						</button>
					</div>
				</div>
				</form>
			</div>
		</div>

		<div class="col-md-12">
			<div class="well">
				<div class="table-responsive">
					<table id="tbDaftarTransaksi" class="table table-striped">
						<thead>
							<tr>
								<th>No Nota</th>
								<th>Nama Pembeli</th>
								<th>Tanggal Transaksi</th>
								<th>Total Pembelian (Rp)</th>
								<th>Operator</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var save_method;
    var table,total_data;

	$(function(){
		//datepicker
        $('#dari').datetimepicker({
            format:'DD-MM-YYYY'
        });

        $('#sampai').datetimepicker({
            format:'DD-MM-YYYY'
        });
		//datepicker
		
		/*Datatable*/
		table = $('#tbDaftarTransaksi').DataTable({
    			
			ordering : 0,

            "language": {
                "search": "Pencarian:",
                "searchPlaceholder": "No Nota...",
                "lengthMenu": "Tampilkan _MENU_ Data",
                "zeroRecords": "Data transaksi kosong",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "oPaginate":{
                	"sPrevious": "Sebelumnya",
                	"sNext": "Selanjutnya",
                }
            },

            "aLengthMenu": [[10, 15, 20, -1], [10, 15, 20, "Semua"]],
            
            "processing": true,
            "serverSide": true,

            "ajax" : {
                "url": "<?php echo base_url('admin/transaksi/daftarTransaksi');?>/",
                "type": "POST",
                "dataType" : "json"
            },

        }); 
		/*Datatable*/
	});
</script>
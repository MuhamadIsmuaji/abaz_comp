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
		/*Datatable*/
		table = $('#tbDaftarTransaksi').DataTable({
    			
			ordering : 0,

            "language": {
                "search": "Pencarian:",
                "searchPlaceholder": "Nama Barang...",
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
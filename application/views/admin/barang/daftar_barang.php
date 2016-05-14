<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Abaz Comp - Daftar Barang</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<a href="#" class="btn btn-primary">
					<strong>Tambah Barang</strong>
				</a>
			</div>
		</div>

		<div class="col-md-12">
			<div class="well">
				<div class="table-responsive">
					<table id="tbDaftarBarang" class="table table-striped">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Stok Barang</th>
								<th>Harga Beli (Rp)</th>
								<th>Harga Jual (Rp)</th>
								<th>Diskon (%)</th>
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
		table = $('#tbDaftarBarang').DataTable({
    			
			ordering : 0,

            "language": {
                "search": "Pencarian:",
                "searchPlaceholder": "Nama Barang...",
                "lengthMenu": "Tampilkan _MENU_ Data",
                "zeroRecords": "Data barang kosong",
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
                "url": "<?php echo base_url('admin/barang/daftarBarang');?>/",
                "type": "POST",
                "dataType" : "json"
            },

        }); 
		/*Datatable*/
	});
</script>
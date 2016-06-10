<div class="modal fade" tabindex="-1" id="konfirmasi_transaksi" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Simpan Transaksi</h4>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
              <div class="col-md-2 col-md-offset-2">
                <div class="form-group">
                  <label for="exampleInputtext1">Tanggal Pembelian</label>
                  <input type="text" class="form-control" id="tgl_pembelian" placeholder="Tanggal Pembelian" name="tgl_pembelian" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-md-offset-2">
                <div class="form-group">
                  <label for="exampleInputtext1">Nama Pembeli</label>
                  <input type="text" class="form-control" id="nama_pembeli" placeholder="Nama Pembeli" name="nama_pembeli" required>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpan_transaksi">Simpan Transaksi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
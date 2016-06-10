<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

	function construct() {
		parent::__construct();
	}


	public function index() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		redirect('admin/transaksi','refresh');
	}

	public function daftarDetailTransaksi($no_nota = NULL) {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		// if ( empty($_POST) ) {
		// 	redirect('admin/transaksi','refresh');
		// }

		$list = $this->M_detailtransaksi->daftarDetailTransaksi($no_nota);
		$no = $this->input->post('start');
		$data = array();
		$no_cb = 1;

		foreach ($list as $detailTransaksi) {

			$no++;
			$row = array();
			
			$row[] = $detailTransaksi->kode_barang;
			$row[] = $detailTransaksi->nama_barang;
			$row[] = $detailTransaksi->jumlah;
			$row[] = $detailTransaksi->harga_satuan;
			$row[] = $detailTransaksi->jumlah_harga;
			$row[] = 'aa';
			$data[] = $row;
			
		}

		$output = array(
			"draw"  			=> $this->input->post('draw'),
			"recordsTotal"      => $this->M_detailtransaksi->countAll(),
			"recordsFiltered"   => $this->M_detailtransaksi->countFiltered($no_nota),
			"data"              => $data,
		);

		echo json_encode($output);
	}

}

/* End of file DetailTransaksi.php */
/* Location: ./application/controllers/admin/DetailTransaksi.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function construct() {
		parent::__construct();
	}

	public function index() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		$noNotaMax = $this->M_transaksi->getMaxNota();
		$noNotaMax += 1; 

		$data = [
			'judul'		=> 'Data Transaksi',
			'content'	=> 'admin/transaksi/daftar_transaksi',
			'noNotaMax'	=> $noNotaMax
		];

		$this->load->view('template',$data);
	}

	public function daftarTransaksi() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_POST) ) {
			redirect('admin/transaksi','refresh');
		}

		$list = $this->M_transaksi->daftarTransaksi();
		$no = $this->input->post('start');
		$data = array();
		$no_cb = 1;

		foreach ($list as $transaksi) {

			$no++;
			$row = array();
			
			$row[] = $transaksi->no_nota;
			$row[] = $transaksi->nama_pembeli;
			$tgl_transaksi = new DateTime($transaksi->tgl_pembelian);
			$row[] = $tgl_transaksi->format('d-m-Y');
			$row[] = $transaksi->total_pembelian;
			$row[] = $transaksi->operator;
			$row[] = 'aaa';
			$data[] = $row;

			
		}

		$output = array(
			"draw"  			=> $this->input->post('draw'),
			"recordsTotal"      => $this->M_transaksi->countAll(),
			"recordsFiltered"   => $this->M_transaksi->countFiltered(),
			"data"              => $data,
		);

		echo json_encode($output);

	}

	public function tambahTransaksi($notaMax = NULL) {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( $notaMax == NULL ) {
			redirect('admin/transaksi','refresh');
		}

		$total_pembelian = 0;
		$detailTransaksi = $this->M_detailtransaksi->getDetailByNota($notaMax)->result(); 

		foreach ($detailTransaksi as $value) {
			$total_pembelian += $value->jumlah_harga;
		}


		$data = [
			'judul'				=> 'Tambah Transaksi',
			'content'			=> 'admin/transaksi/tambah_transaksi',
			'detailTransaksi'	=> $detailTransaksi,
			'notaMax'			=> $notaMax,
			'total_pembelian'	=> $total_pembelian
		];

		$this->load->view('template',$data);
	}

	public function getMaxNota() {
		$noNotaMax = $this->M_transaksi->getMaxNota();
		$noNotaMax += 1; 

		echo json_encode(array('nota_max' => $noNotaMax));
	}

	public function getBarangAutoComplete() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_GET) ) {
			redirect('admin/transaksi','refresh');
		}

		$dataBarang = $this->M_barang->getBarangAutoComplete($this->input->get('term'))->result();

		foreach ($dataBarang as $barang) {
			$data[] = array(
				'label'		=> $barang->kode_barang,
				'value'		=> $barang->nama_barang,
				'harga_jual'=> $barang->harga_jual,
				'diskon'	=> $barang->diskon
			); 	
		} 

		echo json_encode($data);
	}

	public function tambahTransaksiProses() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_POST) ) {
			redirect('admin/transaksi','refresh');
		}

		$no_nota  = $this->input->post('no_nota');

		$tgl_pembelian  = NULL;
		$nama_pembeli  = NULL;
		
		$total_pembelian  = $this->input->post('total_harga');
		$operator  = $this->input->post('operator');

		$kode_barang = $this->input->post('kode_barang');
		$jumlah = $this->input->post('jumlah');
		$harga_satuan = $this->input->post('harga_satuan');
		$jumlah_harga = $this->input->post('jumlah_harga');

		$cek = $this->M_transaksi->getTransaksiByNota($no_nota)->num_rows();
		$cekDetail = $this->M_detailtransaksi->getDetail($no_nota,$kode_barang)->num_rows();
		$cekBarang = $this->M_barang->getBarang($kode_barang)->row();

		$detail = $this->M_detailtransaksi->getDetail($no_nota,$kode_barang)->row();

		if ( $detail ) {
			$sisa = $cekBarang->stock_barang + $detail->jumlah;

			$updateBarang = ['stock_barang' => $sisa];
			$updateStock = $this->M_barang->update($updateBarang,$kode_barang);
		}

		$cekBarang = $this->M_barang->getBarang($kode_barang)->row();

		if ( $cekBarang->stock_barang >= $jumlah ) { // stock memadahi

			$dataTransaksi = [
				'no_nota'			=> $no_nota,
				'tgl_pembelian'		=> $tgl_pembelian,
				'nama_pembeli'		=> $nama_pembeli,
				'total_pembelian'	=> $total_pembelian,
				'operator'			=> $operator
			];

			$dataDetailTransaksi = [
				'nomer_nota'	=> $no_nota,
				'kode_barang'	=> $kode_barang,
				'jumlah'		=> $jumlah,
				'harga_satuan'	=> $harga_satuan,
				'jumlah_harga'	=> $jumlah_harga
			];

			// untuk cek di transaksi
			if ( $cek == 0 ) { // transaksi baru (insert)

				$insert = $this->M_transaksi->insert($dataTransaksi);

			} else { // transaksi lama (update)

				$update = $this->M_transaksi->update($no_nota,$dataTransaksi);

			}
			// untuk cek di transaksi

			// untuk cek di detail transaksi
			if ( $cekDetail == 0 ) {			

				$insertDetail = $this->M_detailtransaksi->insert($dataDetailTransaksi);

			} else {

				$updateDetail = $this->M_detailtransaksi->update($no_nota,$kode_barang,$dataDetailTransaksi);

			}
			// untuk cek di detail transaksi

			$cekBarang2 = $this->M_barang->getBarang($kode_barang)->row();
			$sisa2 = $cekBarang2->stock_barang - $jumlah;
			
			$updateBarang = ['stock_barang' => $sisa2];
			$updateStock = $this->M_barang->update($updateBarang,$kode_barang);
			
			$errorJumlah = 0;

		} else { // stock tidak memadahi
			$cekBarang2 = $this->M_barang->getBarang($kode_barang)->row();
			$detail2 = $this->M_detailtransaksi->getDetail($no_nota,$kode_barang)->row();
			$sisa3 = $cekBarang2->stock_barang - $detail2->jumlah;

			$updateBarang = ['stock_barang' => $sisa3];
			$updateStock = $this->M_barang->update($updateBarang,$kode_barang);

			$errorJumlah = 1;
		}
		
		echo json_encode($errorJumlah);
	}

	public function simpanTransaksi() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_POST) ) {
			redirect('admin/transaksi','refresh');
		}

		$no_nota = $this->input->post('no_nota');
		$tgl = new DateTime($this->input->post('tgl_pembelian'));
		$tgl_pembelian = $tgl->format('Y-m-d');
		$nama_pembeli = $this->input->post('nama_pembeli');
		$total_pembelian = $this->input->post('total_harga');		

		$dataTransaksi = [
			'tgl_pembelian'		=> $tgl_pembelian,
			'nama_pembeli'		=> $nama_pembeli,
			'total_pembelian'	=> $total_pembelian,
		];

		$update = $this->M_transaksi->update($no_nota,$dataTransaksi);

		if ( $update ) {
			echo json_encode(0);
		} else {
			echo json_encode(1);			
		}

	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/admin/Transaksi.php */
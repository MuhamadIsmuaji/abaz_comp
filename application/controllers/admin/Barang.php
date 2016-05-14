<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function construct() {
		parent::__construct();
	}

	public function index() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		$data = [
			'judul'		=> 'Data Barang',
			'content'	=> 'admin/barang/daftar_barang'
		];

		$this->load->view('template',$data);
	}

	public function daftarBarang() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_POST) ) {
			redirect('admin/barang','refresh');
		}

		$list = $this->M_barang->daftarBarang();
        $no = $this->input->post('start');
        $data = array();
        $no_cb = 1;

        foreach ($list as $barang) {
        	$no++;
            $row = array();

            $aksi = '
				<a href="#" class="btn btn-primary">
					<strong>Edit</strong> 
				</a>
				<a href="#" class="btn btn-danger">
					<strong>Hapus</strong> 
				</a>
            ';

            $row[] = $barang->kode_barang;
            $row[] = $barang->nama_barang;
            $row[] = $barang->stock_barang;
            $row[] = $barang->harga_beli;
            $row[] = $barang->harga_jual;
            $row[] = $barang->diskon;
            $row[] = $aksi;
            $data[] = $row;
        }

        $output = array(
            "draw"  			=> $this->input->post('draw'),
            "recordsTotal"      => $this->M_barang->countAll(),
            "recordsFiltered"   => $this->M_barang->countFiltered(),
            "data"              => $data,
        );

        echo json_encode($output);
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/admin/Barang.php */
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

	public function tambahBarang() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}
		
		$katagori = $this->M_katagori->getKatagori()->result();

		$data = [
		'judul'		=> 'Tambah Barang',
		'content'	=> 'admin/barang/tambah_barang',
		'katagori'      =>  $katagori
		];

		$this->load->view('template',$data);
	}

	public function delete($kode_barang = NULL) {

		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}
		
		$dataBarang = $this->M_barang->getBarang($kode_barang)->row();
		$foto = 'assets/img/produk/'.$dataBarang->gambar;
		$deleteProcess = $this->M_barang->delete($kode_barang);

		if ( $deleteProcess ) {
			unlink($foto);
			redirect('admin/barang','refresh');
		}
	}

	public function update($kode_barang = NULL){
		
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( $kode_barang == NULL ) {
			redirect('admin/barang','refresh');
		}

		$barang = $this->M_barang->getBarang($kode_barang)->row();

		if ( !$barang ) {
			redirect('admin/barang','refresh');
		}

		$katagori = $this->M_katagori->getKatagori()->result();
		
		$data = [
			'content' 		=> 'admin/barang/update',
			'judul'			=> 'Update Barang',
			'barang'		=>	$barang,
			'katagori'      =>  $katagori
		];

		$this->load->view('template', $data);
	}

	public function updateProcess() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( !empty($_POST) ) {
			
			$kode_barang_baru = $this->input->post('kode_barang');
			$kode_barang_lama = $this->input->post('kode_barang_cek');

			if ( $kode_barang_lama == $kode_barang_baru ) { // kode barang tidak diganti

				$barang = $this->M_barang->getBarang($kode_barang_lama)->row();

				if ( $_FILES["gambar"]["name"]  ) { // jika foto diganti

					$config['upload_path']          = './assets/img/produk/';
					$config['allowed_types']        = 'jpg|png|gif';
					$config['max_size']             = 10000; //2 MB
					$config['remove_spaces']        = TRUE;
					$config['file_ext_tolower']		= TRUE;
					$config['overwrite']			= false;
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('gambar') ) { // Jika upload file lampiran tidak sesuai
						$errorUpload = 1;
					} else { // berhasil upload
						$errorUpload = 0;
						$foto = 'assets/img/produk/'.$barang->gambar;
						// penghapusan foto
						unlink($foto);
						$gambar = $this->upload->data('file_name');;
					}

				} else { // jika foto tidak diganti
					$errorUpload = 0; 
					$gambar = $barang->gambar;
				}

				if ( $errorUpload == 1 ) { // upload gambar tidak sesuai
					echo "<script>alert('Format Gambar Tidak Sesuai')</script>";
					redirect('admin/barang','refresh');
				} else {

					$barangUpdate = [
						'kode_barang'	=> $this->input->post('kode_barang'),
						'nama_barang'	=> $this->input->post('nama_barang'),
						'stock_barang'	=> $this->input->post('stock_barang'),
						'harga_beli'	=> $this->input->post('harga_beli'),
						'harga_jual'	=> $this->input->post('harga_jual'),
						'diskon'		=> $this->input->post('diskon'),
						'katagori'		=> $this->input->post('kategori'),
						'gambar'		=> $gambar
					];

					$updateProcess = $this->M_barang->update($barangUpdate,$kode_barang_baru);

					if ( $updateProcess ) {
						echo "<script>alert('Update Barang Berhasil')</script>";
					} else {
						echo "<script>alert('Update Barang Gagal')</script>";
					}

					redirect('admin/barang','refresh');
				}

				
			} else { // kode barang diganti

				$cekBarang = $this->M_barang->getBarang($kode_barang_baru)->num_rows();

				if ( $cekBarang > 0 ) { // jika kode barang sama
					echo "<script>alert('Kode Barang Sama')</script>";
					redirect('admin/barang','refresh');
				} else { // jika kode barang tidak sama
					
					$barang = $this->M_barang->getBarang($kode_barang_lama)->row();

					if ( $_FILES["gambar"]["name"]  ) { // jika foto diganti

						$config['upload_path']          = './assets/img/produk/';
						$config['allowed_types']        = 'jpg|png|gif';
						$config['max_size']             = 10000; //2 MB
						$config['remove_spaces']        = TRUE;
						$config['file_ext_tolower']		= TRUE;
						$config['overwrite']			= false;
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('gambar') ) { // Jika upload file lampiran tidak sesuai
							$errorUpload = 1;
						} else { // berhasil upload
							$errorUpload = 0;
							$foto = 'assets/img/produk/'.$barang->gambar;
							// penghapusan foto
							unlink($foto);
							$gambar = $this->upload->data('file_name');;
						}

					} else { // jika foto tidak diganti
						$errorUpload = 0; 
						$gambar = $barang->gambar;
					}

					if ( $errorUpload == 1 ) { // upload gambar tidak sesuai
						echo "<script>alert('Format Gambar Tidak Sesuai')</script>";
						redirect('admin/barang','refresh');
					} else {

						$barangUpdate = [
							'kode_barang'	=> $this->input->post('kode_barang'),
							'nama_barang'	=> $this->input->post('nama_barang'),
							'stock_barang'	=> $this->input->post('stock_barang'),
							'harga_beli'	=> $this->input->post('harga_beli'),
							'harga_jual'	=> $this->input->post('harga_jual'),
							'diskon'		=> $this->input->post('diskon'),
							'katagori'		=> $this->input->post('kategori'),
							'gambar'		=> $gambar
						];

						$updateProcess = $this->M_barang->update($barangUpdate,$kode_barang_lama);

						if ( $updateProcess ) {
							echo "<script>alert('Update Barang Berhasil')</script>";
						} else {
							echo "<script>alert('Update Barang Gagal')</script>";
						}

						redirect('admin/barang','refresh');
					}
				}

			}

		} else {
			redirect('admin/barang','refresh');
		}
	}
	
	public function detail($kode_barang = NULL){
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		$barang = $this->M_barang->getBarangJoinKategori($kode_barang)->row();

		$data = [
			'content' 		=> 'admin/barang/detail',
			'judul'			=> 'Detail Barang',
			'barang'		=>	$barang,
		];

		$this->load->view('template', $data);
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
			<a href="'. base_url('admin/barang/update/'.$barang->kode_barang) .'" class="btn btn-primary">
				<strong>Edit</strong> 
			</a>
			<a href="'. base_url('admin/barang/delete/'.$barang->kode_barang) .'" class="btn btn-danger">
				<strong>Hapus</strong> 
			</a>
			<a href="'. base_url('admin/barang/detail/'.$barang->kode_barang) .'" class="btn btn-warning">
				<strong>Detail</strong> 
			</a>
			';

			$row[] = $barang->kode_barang;
			$row[] = $barang->nama_barang;
			$row[] = $barang->stock_barang;
			$row[] = $barang->harga_beli;
			$row[] = $barang->harga_jual;
			$row[] = $barang->diskon;
			
			// Perhitungan diskon
			$diskon = $barang->harga_jual - ( ($barang->diskon/100) * $barang->harga_jual );
			
			$row[] = $diskon;
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

	public function insert() {
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		if ( empty($_POST) ) {
			redirect('admin/barang','refresh');
		} else {
			
			$kode_barang = $this->input->post('kode_barang');
			$cekBarang = $this->M_barang->getBarang($kode_barang)->num_rows();

			if ( $cekBarang > 0 ) {
				echo "<script>alert('Kode Barang Sama')</script>";
				redirect('admin/barang','refresh');
			} else {
				$config['upload_path']          = './assets/img/produk/';
				$config['allowed_types']        = 'jpg|png|gif';
				$config['max_size']             = 10000; //2 MB
				$config['remove_spaces']        = TRUE;
				$config['file_ext_tolower']		= TRUE;
				$config['overwrite']			= false;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('gambar') ) { // Jika upload file lampiran tidak sesuai
					echo "<script>alert('". $this->upload->display_errors()	."')</script>";
					redirect('admin/barang','refresh');

				} else { // Jika upload file lampiran sesuai

					$nama_barang = $this->input->post('nama_barang');
					$stock_barang = $this->input->post('stock_barang');
					$harga_beli = $this->input->post('harga_beli');
					$harga_jual = $this->input->post('harga_jual');
					$diskon = $this->input->post('diskon');
					$katagori = $this->input->post('katagori');
					$gambar = $this->upload->data('file_name');

					$dataBarang = [
						'kode_barang' => $kode_barang,
						'nama_barang' => $nama_barang,
						'stock_barang' => $stock_barang,
						'harga_beli' => $harga_beli,
						'harga_jual' => $harga_jual,
						'diskon' => $diskon,
						'katagori' => $katagori,
						'gambar' => $gambar
					];

					$prosesTambah = $this->M_barang->insert($dataBarang);

					redirect('admin/barang','refresh');

				}
			}
		}
	}

}


/* End of file Barang.php */
/* Location: ./application/controllers/admin/Barang.php */
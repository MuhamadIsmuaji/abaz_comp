<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function construct() {
		parent::__construct();
	}

	public function index() {
		
		if ( ! $this->session->userdata('isAdminAbaz') ) {
			redirect('login','refresh');
		}

		$data = [
			'judul'		=> 'Home Admin',
			'content'	=> 'admin/home/index'
		];

		$this->load->view('template',$data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function construct() {
		parent::__construct();
	}

	public function index() {

		if ( !empty($_POST) ) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$filterData = [
				'username'	=> $username,
				'password'	=> $password
			];

			$user = $this->M_user->getUser($filterData)->row();

			if ( $user ) { // login berhasil

				$sessionUser = [
					'username'		=> $user->username,
					'password'		=> $user->password,
					'isAdminAbaz'	=> 1
				];

				$this->session->set_userdata($sessionUser);

				redirect('admin/home','refresh');

			} else { // login gagal

				$data = [
					'errorLogin' => 1
				];
				
				$this->load->view('admin/login/login',$data);
			}

		} else {
			$data = [
				'errorLogin' => NULL
			];

			$this->load->view('admin/login/login',$data);

		}	
	}

	public function logout() {

		if ( $this->session->userdata('isAdminAbaz') ) {
			$this->session->unset_userdata('isAdminAbaz');
		}

		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
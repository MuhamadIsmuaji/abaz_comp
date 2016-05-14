<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	private $table = 'user';
	private $pktable   = 'username';
	
	function __construct() {
		parent::__construct();
	}

	public function getUser($filterData = NULL) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($filterData);
		$query = $this->db->get();
		return $query;
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
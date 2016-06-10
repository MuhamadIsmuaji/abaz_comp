 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class M_katagori extends CI_Model {

 	private $table = 'kategori';
 	private $pktable   = 'id_kategori';
 

 	function __construct() {
 		parent::__construct();
 	}
 	public function getKatagori() {
 		$this->db->select('*');
 		$this->db->from($this->table);
 		$query = $this->db->get();
 		return $query;
 	}
 }

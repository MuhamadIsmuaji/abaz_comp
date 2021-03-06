<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	private $table = 'barang';
	private $pktable   = 'kode_barang';
	private $column = array('nama_barang');
	private $order = array('kode_barang' => 'asc');
	
	function __construct() {
		parent::__construct();
	}

	private function getDataTablesQuery() {

		$this->db->select('*');
        $this->db->from($this->table);
        // $this->db->join('kategori','barang.katagori = kategori.id_kategori','inner');
        
        $i = 0;
        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }
 
        if(isset($_POST['order']))
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
   
	public function daftarBarang() {
		$this->getDataTablesQuery();
		if($_POST['length'] != -1)
        	$this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}

	public function countAll(){
		return $this->db->count_all($this->table);
	}

	public function countFiltered(){
		$this->getDataTablesQuery();
        $query = $this->db->get();
        return $query->num_rows();
	}
    
    public function delete($kode_barang = null) {
        $this->db->where('kode_barang',$kode_barang);
        return $this->db->delete($this->table);
    }

    public function insert($dataBarang) {
        return $this->db->insert($this->table, $dataBarang);
    }

    public function getBarang($kode_barang = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kode_barang',$kode_barang);
        $query = $this->db->get();
        return $query;
    }

    public function update($dataBarang = null,$kode_barang = null) {
        $this->db->where('kode_barang',$kode_barang);
        return $this->db->update($this->table,$dataBarang);
    }

    public function getBarangJoinKategori($kode_barang = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('kategori','kategori.id_kategori = barang.katagori');
        $this->db->where('barang.kode_barang',$kode_barang);
        $query = $this->db->get();
        return $query;
    }

    public function getBarangAutoComplete($namaBarang = NULL) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('nama_barang',$namaBarang,'both');
        return $this->db->get();
    }
}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */
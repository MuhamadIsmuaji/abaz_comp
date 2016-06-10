<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	private $table = 'transaksi';
	private $pktable   = 'no_nota';
	private $column = array('no_nota');
	private $order = array('no_nota' => 'asc');

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

    public function daftarTransaksi() {
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

    public function getMaxNota() {
        $this->db->select_max('no_nota');
        $query = $this->db->get($this->table)->row();
        return $query->no_nota;
    }

    public function getTransaksiByNota($no_nota = NULL) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->pktable,$no_nota);
        $query = $this->db->get();
        return $query;
    }

    public function insert($dataTransaksi) {
        return $this->db->insert($this->table, $dataTransaksi);
    }

    public function update($no_nota = null, $dataTransaksi = null) {
        $this->db->where($this->pktable,$no_nota);
        return $this->db->update($this->table,$dataTransaksi);
    }


}

/* End of file M_transaksi.php */
/* Location: ./application/models/M_transaksi.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_detailtransaksi extends CI_Model {

	private $table = 'detail_transaksi';
	private $pktable   = 'nomer_nota';
	private $column = array('nama_barang');
	private $order = array('nomer_nota' => 'asc');

	function __construct() {
		parent::__construct();
	}

	private function getDataTablesQuery($no_nota = NULL) {

		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('barang','barang.kode_barang = barang.kode_barang','inner');
        $this->db->where('detail_transaksi.nomer_nota',$no_nota);
        
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

    public function daftarDetailTransaksi($no_nota = NULL) {
		$this->getDataTablesQuery($no_nota);
		if($_POST['length'] != -1)
        	$this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}

	public function countAll(){
		return $this->db->count_all($this->table);
	}

	public function countFiltered($no_nota = NULL){
		$this->getDataTablesQuery($no_nota);
        $query = $this->db->get();
        return $query->num_rows();
	}

	public function insert($dataDetailTransaksi) {
        return $this->db->insert($this->table, $dataDetailTransaksi);
    }

    public function update($no_nota = null,$kode_barang = null, $dataDetailTransaksi = null) {
        $this->db->where($this->pktable,$no_nota);
        $this->db->where('kode_barang',$kode_barang);
        return $this->db->update($this->table,$dataDetailTransaksi);
    }

    public function getDetailByNota($no_nota = NULL) {
    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('barang','barang.kode_barang = detail_transaksi.kode_barang','inner');
        $this->db->where('detail_transaksi.'.$this->pktable,$no_nota);
        $query = $this->db->get();
        return $query;
    }

    public function getDetail($no_nota = NULL, $kode_barang = NULL) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->pktable,$no_nota);
        $this->db->where('kode_barang',$kode_barang);
        $query = $this->db->get();
        return $query;
    }
	
}

/* End of file M_detailtransaksi.php */
/* Location: ./application/models/M_detailtransaksi.php */
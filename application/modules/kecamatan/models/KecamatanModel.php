<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class KecamatanModel Extends CI_Model
{
	private $table = 'kecamatan';
	private $pk = 'kd_kecamatan';
	
	public $kd_kecamatan = null;

	public $nama_kecamatan = null;

	private $_filter_params;
	private $_limit;
	private $_offset;
	private $_result;
	private $_row;
	private $_count;
	private $_tbl_fields;

	public function __construct()
	{
		$this->_tbl_fields = $this->db->list_fields($this->table);
	}

	protected function valkd_kecamatanField($params)
	{
		foreach ($params as $item => $value) {
			if(!in_array($item, $this->_tbl_fields)){
				unset($params[$item]);
			}
		}
		return $params;
	}
	public function save()
	{
		$flag = 0;
		$result['status'] = true;


		$data = [
			'kd_kecamatan' 	=> $this->kd_kecamatan,
			'nama_kecamatan' 	=> $this->nama_kecamatan,
		];

		return $this->db->insert($this->table, $data);		

	}

	public function update()
	{
		$result['status'] = true;
		$result['msg'] = 'Email exist';
		$kd_kecamatan = $this->kd_kecamatan;
		$data = [
			'nama_kecamatan' 	=> $this->nama_kecamatan,
		];
		$this->db->where('kd_kecamatan', $kd_kecamatan);
		return $this->db->update($this->table, $data);		
	}

	public function get()
	{
		if($this->_query){
			$this->_result = $this->_query->result();
			$this->_row = $this->_query->row();
			$this->_count = $this->_query->num_rows();
		}
		return $this;
	}

	public function findAll($filter_params = [], $order = [], $limit = 1000, $current_page = 0)
	{
		if($current_page > 1)
		{
			$current_page -= 1;
		}

		$offset = $current_page * $limit;

		if(!empty($filter_params)){
			$filter_params = $this->valkd_kecamatanField();
			foreach ($filter_params as $item => $value) {
				$this->db->like($item, $value, 'both');
			}
		}
		$this->db->order_by('kd_kecamatan', 'ASC');
		$this->_query = $this->db->get($this->table, $limit, $offset);

		return $this->get();
	}


	public function findOne($id)
	{
		
		$this->_query = $this->db->get_where($this->table, ['kd_kecamatan' => $id]);
		return $this->get();

	}

	public function result()
	{
		return $this->_result;
	}

	public function row()
	{
		return $this->_row;
	}

	public function count()
	{
		return $this->_count;
	}

	
}
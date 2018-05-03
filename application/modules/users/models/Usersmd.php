<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Usersmd Extends CI_Model
{
	private $table = 'users';
	private $pk = 'id';
	
	public $id = null;

	public $first_name = null;
	public $last_name = null;
	public $sex = null;
	public $email = null;
	public $phone = null;
	public $username = null;
	public $auth_key = null;
	public $password = null;
	public $password_reset_token = null;
	public $created = null;
	public $updated = null;

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

	protected function validField($params)
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
		$result['msg'] = 'Email exist';


		$data = [
			'id' 	=> $this->id,
			'first_name' 	=> $this->first_name,
			'last_name' 	=> $this->last_name,
			'sex' 			=> $this->sex,
			'email' 		=> $this->email,
			'phone' 		=> $this->phone,
			'username' 		=> $this->username,
			'auth_key' 		=> $this->auth_key,
			'password' 	=> $this->password,
			'password_reset_token' 	=> $this->password_reset_token,
			'created' 		=> $this->created,
		];

		return $this->db->insert($this->table, $data);		

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

	public function findAll($filter_params = [], $order = [], $limit = 10, $current_page = 0)
	{
		if($current_page > 1)
		{
			$current_page -= 1;
		}

		$offset = $current_page * $limit;

		if(!empty($filter_params)){
			$filter_params = $this->validField();
			foreach ($filter_params as $item => $value) {
				$this->db->like($item, $value, 'both');
			}
		}

		$this->_query = $this->db->get($this->table, $limit, $offset);

		return $this->get();
	}


	public function findOne()
	{


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

	public function getEmail($email = null)
	{
		return $this->db->get_where($this->table, ['email' => $email]);
	}
	
	public function getUsername($username = null)
	{

		return $this->db->get_where($this->table, ['username' => $username ]);
	}

	public function generateId()
	{	
        return current_time('strtotime') . strtoupper(hash('crc32b',UNIQID()));	
	}
}
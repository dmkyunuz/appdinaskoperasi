<?php

Class App
{ 
	private $ci;
	private $_request;
	private $session_user_name;

	/*Constructor*/
	public function __construct(){
		$this->ci = &get_instance();

	}

	/** Perintah untuk menerima type http request (post, get)
	@return : object
	*/
	public function request()
	{
		$this->_request = $this->ci->input->server('REQUEST_METHOD');
		return $this;
	}

	/** Perintah untuk mendefinisikan bahwa requst http yang diminta adalah post
	** @return boolean
	*/
	public function post()
	{
		if($this->_request == 'POST'){
			return true;
		}else{
			return false;
		}
	}

	/* Perintah untuk mendapatkan informasi user yang login.
	** @return object
	*/
	public function user()
	{
		$user = $this->ci->session->userdata($this->ci->auth->user_session_name);
		$this->ci->db->select('*');
		return $this->ci->db->get_where('penilai', ['username' => $user['username'] ])
							->row();
	}

}
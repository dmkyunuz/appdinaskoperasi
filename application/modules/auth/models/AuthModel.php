<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class AuthModel extends CI_Model{

    public function __construct()
    {

    }

    public function getUser()
    {
        $data = [
            'username' => $this->username,
            'password' => md5($this->password),
        ];

        $this->db->select('username, nama_penilai');
        $query = $this->db->get_where('penilai', $data);

        $row_count = $query->num_rows();
        $row = $query->row();

        if($row_count > 0){
            
        }else{

        }

    }

    // public 
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth{

    private $ci;
    
    public $user_session_name = "user";
    public $user_cookie_name;
    public $username;
    public $password;
    public $remember = false;
    /*@url variabel session name url*/
    public $_url = 'url';

    /*Constructor*/
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->session->userdata('url');
    }
    /* auth check
    ** @return boolean
    */
    public function check()
    {
        $session_user =  $this->ci->session->userdata($this->user_session_name);
        if($session_user == false){
            $request_url = current_url();
            $this->ci->session->set_tempdata([$this->_url => $request_url]);
            redirect('/main/login');
        }else{
            return;
        }
    }

    /* login if cookie remember true */
    public function findUserByCookie()
    {
        $cookie = $this->ci->input->cookie('remember', false);

        $this->ci->db->select("penilai.*");
        $this->ci->db->join('penilai', 'penilai.nip=usercookie.nip', 'left');
        $query = $this->ci->db->get_where('usercookie', ['auth_key' => $cookie]);
        $row_count = $query->num_rows();
        $row = $query->row();
        if($row > 0){
            $this->ci->session->set_userdata($this->user_session_name, ['username' => $row->username]);
            redirect(site_url('/'));
        }else{
            redirect(site_url('/main/login'));
        }

    }

    /*Process login*/
    public function login()
    {
        $data = ['username' => $this->username,
             'password' => md5($this->password) ];
        $query = $this->ci->db->select("*")
                    ->get_where('penilai', $data);
        $row_count = $query->num_rows();
        $row = $query->row();
        if($row_count > 0){
               
            $this->ci->session->set_userdata($this->user_session_name, ['username' => $row->username]);
            if($this->remember == true){

                $cookie= array(
                       'name'   => 'remember',
                       'value'  => md5(uniqid(rand())),
                       'expire' =>  0,
                       'secure' => FALSE
                   );
                   $this->ci->input->set_cookie($cookie);
                   $this->ci->db->replace('usercookie', ['nip' => $row->nip, 'auth_key' => $cookie['value']]);
            }

            return true;
        }else{
            return false;
        }
    }

    /*  filter controller & method
    *@params : array
    */
    public function access_control($params = [])
    {
        $class = $this->ci->router->fetch_class();
        $method = $this->ci->router->fetch_method();
        $user_permission = ['class' => ['dashboard'], 'method' => ['index', 'test']];
        $index_permission = array_search($method, $user_permission['method']);
        $user_access_item = $user_permission['method'][$index_permission];

        $result = false;
        if(in_array($method, $user_permission['method'])){
            
            if(in_array($user_access_item, $params['rules'][1]['action'])){
                $result = true;
            }
            
        }

        if($result){
            return;
        }else{
            die('You not allowed access this page');
        }
        
       
    }

    
}
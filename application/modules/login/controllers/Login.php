<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if( $this->session->userdata('user') ){
            
        }
    }

    public function index()
    {
        if( $this->session->userdata('user') ){
            redirect(base_url());
        }
        $request = $this->app->request();
        if($request->post() && $this->input->is_ajax_request()){
            $result['status'] = 'failed';
            $result['message'] = 'Username atau password salah';
            $auth = $this->auth;
            $auth->username = $this->input->post('username');
            $auth->password = $this->input->post('password');
            
            $login = $auth->login();
            if($login){
                $result['status'] = 'success';
                $result['message'] = '';
                $result['redirect'] = ($this->session->userdata('url')) ? $this->session->userdata('url') : site_url()."/" ;
            }
            echo json_encode($result);
        }else{
            Web::Render('index', null, 'login');
        }
       
    }


    public function logout()
    {
        $this->session->unset_userdata($this->auth->user_session_name);
        // if($logout){
            redirect('/');
        // }
    }

}
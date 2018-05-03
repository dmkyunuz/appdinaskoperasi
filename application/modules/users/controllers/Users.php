<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller  {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users/Usersmd', 'usersmd');
      	$this->load->helpers(['dates', 'clients']);

    }

	public function index()
	{
		$request = $this->app->request();
		$model = $this->usersmd->findAll()->result();
		Web::setTitle('Users');

		if($this->input->is_ajax_request()){

			if(!$request->post()){

				$output = [
					'html'=> $this->load->view("index",['model' => $model], true),
					'head' => ''
				];

			}else{

			}

			

			echo json_encode($output);

		}else{
			
			Web::Render('index', ['model' => $model]);
		}

	}

	public function create()
	{
		$request = $this->app->request();

		if($this->input->is_ajax_request()){
			if($request->post()){
				$result['status'] = 'failed';
				$result['msg'] = 'Save users failed';

				$model = $this->usersmd;

				$model->id = $model->generateId();
				$model->first_name = trim($this->input->post('first_name'));
				$model->last_name = trim($this->input->post('last_name'));
				$model->sex = trim($this->input->post('sex'));
				$model->phone = trim($this->input->post('phone'));
				$model->email = trim($this->input->post('email'));
				$model->username = trim($this->input->post('username'));
				$model->password = trim($this->input->post('password'));
				$model->created = date('Y-m-d H:i:s');

				$email_check = $this->usersmd->getEmail($model->email)->num_rows();

				$username_check = $this->usersmd->getUsername($model->username)->num_rows();

				
				if($email_check > 0|| $username_check > 0)
				{
					if($email_check > 0 ){
						$result['msg'] = 'Email alredy exist';
					}else if($username_check > 0 ){
						$result['msg'] = 'Username alredy exist';
					}
					
				}else{
					if($model->save())
					{
						$result['status'] = 'success';
						$result['msg'] = 'Save user success';
					}
				}

				echo json_encode($result);
			
			}else{
				Web::RenderAjax('create');
			}
		}else{
			die('Access denied');
		}
	}

	public function store()
	{


		/*$model->id = $model->generateId();
		$model->first_name = 'First';
		$model->last_name = 'Last';
		$model->sex = 'M';
		$model->email = 'masdasdd';
		$model->username = 'testd';
		$model->password = 'password';
		$model->created = date('Y-m-d H:i:s');
		$model->save();*/
	}

	


}

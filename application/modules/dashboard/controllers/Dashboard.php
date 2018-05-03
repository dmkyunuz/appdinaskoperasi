<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller  {

	function __construct()
    {
        parent::__construct();
      	$this->auth->check();
      	$this->auth->access_control([
      			'rules' => [
      				[
                        'actions' => ['login'],
                        'allow' => true,
                    ],
      				[
      					'action' => ['index', 'test'],
      					'allow' => true,
                    	'roles' => ['@'],
                	],

      			],
      	]);

    }

	public function index($id = null)
	{
		Web::setTitle('asd');
		if($this->input->is_ajax_request()){
			$output = array(
		        'html'=> $this->load->view("index",'', true),
			        'data' =>''
			    );
			echo json_encode($output);
		}else{
			Web::Render('index');
		}
		
		// echo json_encode($output);
	}

	public function test(){

	}
}

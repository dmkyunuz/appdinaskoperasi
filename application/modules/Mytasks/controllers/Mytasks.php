<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mytasks extends MX_Controller  {

	function __construct()
    {
        parent::__construct();

		$this->load->model('mytasks/Mytasksmd', 'mytasksmd');
      	$this->load->helpers(['dates', 'clients']);
      	$this->auth->check();
    }

	public function index()
	{
		// $model = mytasksmd::skip(0)->take(5)->get();
		$model = [];
		Web::setTitle('My Task');
		if($this->input->is_ajax_request()){
			$output = [
				'html'=> $this->load->view("index",['model' => $model], true),
				'data' =>''
			];
			echo json_encode($output);
		}else{
			Web::Render('index', ['model' => $model]);
		}
		
	}

	public function create()
	{
		Web::setTitle('Create Task');
		if($this->input->is_ajax_request()){
			$output = array(
	        'html'=> $this->load->view("create",'', true),
		        'data' =>''
		    );
			echo json_encode($output);
		}else{
			Web::Render('create');
		}
	}

	public function show()
	{
		
	}

	public function store()
	{
		$model = [];
		$model->name = 'Bogel';
		$model->save();
	}

	public function test()
	{
		echo $this->mytasksmd->generateId();
	}


}

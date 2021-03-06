<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends MX_Controller  {

	function __construct()
    {
        parent::__construct();
		$this->auth->check();
		$this->load->model('kecamatan/KecamatanModel', 'kecamatanmodel');

    }

	public function index()
	{
		$request = $this->app->request();
		$model = $this->BentukKoperasiModel->findAll()->result();
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

				$model = $this->BentukKoperasiModel;

				$model->kd_bk = trim($this->input->post('kd_bk'));
				$model->nama_bk = trim($this->input->post('nama_bk'));
				$model->kepanjangan = trim($this->input->post('kepanjangan'));

				
				if($model->save())
				{
					$message = "Berhasil menambahkan data.";
					Web::CreateAlert('alert-success', $message, 'message');

					$result['status'] = 'success';
					$result['msg'] = 'Save user success';
				}

				echo json_encode($result);
			
			}else{
				$kode_bk = $this->generateID('bentuk_koperasi', 'BK' , 'kd_bk');
				Web::RenderAjax('create', ['kode_bk' => $kode_bk ]);
			}
		}else{
			die('Access denied');
		}
	}

	public function unique_check()
	{
		$nama_bk = trim($this->input->post('nama_bk') ? $this->input->post('nama_bk') : false);
		$id = trim($this->input->post('id') ? $this->input->post('id') : false);
		$this->db->select("*");
		$this->db->where('nama_bk', $nama_bk);
		if($id){
			$this->db->where('kd_bk !=', $id);
		}
		$row_count = $this->db->get('bentuk_koperasi')->num_rows();
		
		if($row_count == true){
			echo "false";
		}else{
			echo "true";
		}

	}

	public function update($id)
	{
		$request = $this->app->request();
		$kd_bk = $id;

		$model = $this->BentukKoperasiModel;
		if($this->input->is_ajax_request()){
			if($request->post()){
				$result['status'] = 'failed';
				$result['msg'] = 'Save users failed';

				$model = $this->BentukKoperasiModel;

				$model->kd_bk = trim($id);
				$model->nama_bk = trim($this->input->post('nama_bk'));
				$model->kepanjangan = trim($this->input->post('kepanjangan'));

				
				if($model->update())
				{
					$message = "Berhasil menambahkan data.";
					Web::CreateAlert('alert-success', $message, 'message');

					$result['status'] = 'success';
					$result['msg'] = 'Save user success';
				}

				echo json_encode($result);
			}else{
				$model = $model->findOne($kd_bk)->row();
				Web::RenderAjax('update', ['model' => $model ]);
			}
			
		}
		

	}

	public function test()
	{
		$this->generateID('bentuk_koperasi', 'BK' , 'kd_bk');
	}

	protected function generateID($tabel, $inisial, $field){
		$fields = $this->db->field_data($tabel);
		$i = 0;
		$offset = 0;
		foreach ($fields as $item => $value) {
			foreach ($value as $key => $val) {

				if($fields[$i]->name == $field){
					$offset =+ $i;
				}

			}

			$i++;
		}
		
		$fields = $fields[$offset];
		$fieldln = $fields->max_length;
		
		$query = $this->db->select('MAX('.$fields->name.') as last')
						->from($tabel)
						->get();
		$row = $query->row();
		$row_count = $query->num_rows();

		if($row_count == 0){
			$angka = 0;
		}else{
			$angka = substr($row->last, strlen($inisial));
		}

		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i = 1; $i <= ($fieldln - strlen($inisial)-strlen($angka)); $i++ ) { 
			$tmp = $tmp."0";
		}
		
	 	return $inisial.$tmp.$angka;
	}

	public function delete($id = null){;
		$model = $this->BentukKoperasiModel;
		if($id == false){
			return die('Error');
		}

		$kd_bk = $id;
		if($this->db->delete('bentuk_koperasi', ['kd_bk' => $id])){
			
			$message = "Berhasil menghapus data.";
			Web::CreateAlert('alert-success', $message, 'message');
			
			redirect('/bentuk-koperasi');
		}
	}

}

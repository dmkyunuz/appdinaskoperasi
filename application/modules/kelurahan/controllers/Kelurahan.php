<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends MX_Controller  {

	function __construct()
    {
        parent::__construct();
		$this->auth->check();
		$this->load->model('kelurahan/KelurahanModel', 'kelurahanmodel');
		$this->load->model('kecamatan/KecamatanModel', 'kecamatanmodel');

    }

	public function index()
	{
		$request = $this->app->request();
		$model = $this->kelurahanmodel
					->leftJoin('kecamatan', 'kecamatan.kd_kecamatan=kelurahan.kd_kec')
					->findAll()
					->result();
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

				$model = $this->kelurahanmodel;

				$model->kd_kelurahan = trim($this->input->post('kd_kelurahan'));
				$model->nama_kelurahan = strtoupper(trim($this->input->post('nama_kelurahan')));
				$model->kd_kec = trim($this->input->post('kd_kec'));

				
				if($model->save())
				{
					$message = "Berhasil menambahkan data.";
					Web::CreateAlert('alert-success', $message, 'message');

					$result['status'] = 'success';
					$result['msg'] = 'Save user success';
				}

				echo json_encode($result);
			
			}else{

				$kecamatan = $this->kecamatanmodel->findAll()->result();
				$kd_kelurahan = $this->generateID('kelurahan', 'L' , 'kd_kelurahan');
				Web::RenderAjax('create', ['kd_kelurahan' => $kd_kelurahan, 'kecamatan' =>$kecamatan ]);
			}
		}else{
			die('Access denied');
		}
	}

	public function unique_check()
	{
		$nama_kelurahan = trim($this->input->post('nama_kelurahan') ? $this->input->post('nama_kelurahan') : false);
		$id = trim($this->input->post('id') ? $this->input->post('id') : false);
		$this->db->select("*");
		$this->db->where('nama_kelurahan', $nama_kelurahan);
		if($id){
			$this->db->where('kd_kelurahan !=', $id);
		}
		$row_count = $this->db->get('kelurahan')->num_rows();
		
		if($row_count == true){
			echo "false";
		}else{
			echo "true";
		}

	}

	public function update($id)
	{
		$request = $this->app->request();
		$kd_kelurahan = $id;

		$model = $this->kelurahanmodel;
		if($this->input->is_ajax_request()){
			if($request->post()){
				$result['status'] = 'failed';
				$result['msg'] = 'Save users failed';

				$model = $this->kelurahanmodel;

				$model->kd_kelurahan = trim($id);
				$model->nama_kelurahan = strtoupper(trim($this->input->post('nama_kelurahan')));
				$model->kd_kec = trim($this->input->post('kd_kec'));

				
				if($model->update())
				{
					$message = "Berhasil menambahkan data.";
					Web::CreateAlert('alert-success', $message, 'message');

					$result['status'] = 'success';
					$result['msg'] = 'Save user success';
				}

				echo json_encode($result);
			}else{

				$kecamatan = $this->kecamatanmodel->findAll()->result();
				$model = $model->findOne($kd_kelurahan)->row();
				Web::RenderAjax('update', ['model' => $model, 'kecamatan' => $kecamatan ]);
			}
			
		}
		

	}

	public function test()
	{
		$this->generateID('kelurahan', 'L' , 'kd_kelurahan');
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
		$model = $this->kelurahanmodel;
		if($id == false){
			return die('Error');
		}

		$kd_kelurahan = $id;
		if($this->db->delete('kelurahan', ['kd_kelurahan' => $id])){
			
			$message = "Berhasil menghapus data.";
			Web::CreateAlert('alert-success', $message, 'message');
			
			redirect('/kelurahan');
		}
	}

}

<?php

Class Web
{

	/*Nama Class : Web
	** Fungsi digunakan untuk pengaturan meta html, register css, register javascript, title web, & rendering view
	*/
	protected static $ci;
	protected $CI;
	protected $_css;
	protected $_js;
	protected $_jqueryPlugins;
	protected static $header_title;
	public $path;
	public static $_alert;
	private static $_meta = [];
	

	public function __construct()
	{
		self::$ci = &get_instance();
		$this->CI = &get_instance();
	}

	/** Perintah untuk memulai register css atau javascript
	** @return : object
	*/
	public function Register(){
		$assets = $this->CI->config->item('assets');
		$this->_css = $assets['css'];
		$this->_js = $assets['js'];
		$this->_jqueryPlugins = $assets['jqueryPlugins'];
		return $this;
	}

	/*Fungsi ini untuk meng-generate link css dari fungsi Register()
	** @return string
	*/
	public function css(){
		$css = $this->_css;
		$output = '';
		$path = '/';
		foreach ($css as $key) {
			$url = site_url($path . $key);
			if(substr($key, 0,4) == "http" || substr($key, 0,5) == "https" || substr($key, 0, 2) == "//"){
				$url = $key;
			}
			$output .= '<link rel="stylesheet" href="' .$url. '" type="text/css">';
			$output .= "\n";
		}

		echo $output;
	}

	/*Fungsi ini untuk meng-generate link js di posisi head dari fungsi Register()
	** @return string
	*/
	public function js(){
		$js = $this->_js;
		$output = '';
		$path = '/';
		foreach ($js as $key) {
			$url = site_url($path . $key);
			if(substr($key, 0,5) == "https" || substr($key, 0, 2) == "//"){
				$url = $key;
			}
			$output .= '<script src="' .$url. '" type="text/javascript"></script>';
			$output .= "\n";
			// echo 1;
		}

		echo $output;
	}

	/*Fungsi ini untuk meng-generate link js di dalam html body. digenerate dari fungsi Register()
	** @return string
	*/
	public function jqueryPlugins(){
		$jp = $this->_jqueryPlugins;
		$output = '';
		$path = '/';
		foreach ($jp as $key) {
			$url = site_url($path . $key);
			if(substr($key, 0,5) == "https" || substr($key, 0, 2) == "//"){
				$url = $key;
			}
			$output .= '<script src="' .$url. '" type="text/javascript"></script>';
			$output .= "\n";
			// echo 1;
		}

		echo $output;
	}

	/** Perintah untuk setting meta dari controller
	** @params : array(type meta, value meta)
	** @return array
	*/
	public function setMeta($params = [])
	{
		$output_meta = [];
		foreach ($params as $meta_name => $meta_value) 
		{
			$output_meta[] = '<meta name="'.$meta_name.'" content="'.$meta_value.'">';
		}

		self::$_meta[] = $output_meta;
	}


	/** Perintah untuk mencetak meta ke template. 
	** fungsi ini di dapatkan dari fungsi setMeta() yang ditampung ke dalam object $_meta;
	** array(type meta, value meta)
	** @return string
	*/
	public function getMeta(){
		$print = '';
		foreach (self::$_meta as $key) 
			{
				foreach ($key as $a => $b) 
				{
					$print .=$b;
					$print .= "\n";
				}
			
		}
		
		return $print;
	}

	/** Perintah untuk mengatur title yang akan muncul di html title.
	** @return string
	*/
	public static function setTitle($str_title = null)
	{
		self::$ci =&get_instance();
		$prefix = 'Dinas Koperasi';
	    self::$header_title = $prefix. " | " .ucwords($str_title);
	}

	/** Perintah untuk mengenerate title di html title. 
	** fungsi ini di dapatkan dari fungsi setTitle() yang ditampung ke dalam object $header_title;
	** @return string
	*/
	public static function getTitle()
	{
		$ci =&get_instance();
	    return (self::$header_title) ? self::$header_title : 'Dinas Koperasi';
	}


	/** Perintah untuk menggunakan templating 
	** @view_name content view yang akan di render.
	** @params : array. adalah parameter yang akan di sertakan ke dalam view content
	** @layout : layout yang akan digunakan. letak layout ada di folder application/viewss/. secara default akan merender index
	*/

	public static function render($view_name, $params = array(), $layout = 'default')
	{
		$view_content = self::$ci->load->view($view_name, $params, TRUE); 
		if(!self::$ci->input->is_ajax_request()){
			if($layout == 'login'){
				self::$ci->load->view('/layout/login', [ 'content_for_layout' => $view_content ]);
			}else{
				self::$ci->load->view('/layout/index', [ 'content_for_layout' => $view_content ]);
			}
			
		}else {
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				self::$ci->load->view($view_name, $params, TRUE);
			}else{
				self::$ci->load->view($view_name, $params, TRUE);	
			}
		}
	}

	/** Render View melalui request ajax. Tidak menyertakan template manapun 
	** alias langsung merender mencari nama view di dalam modules yang diminta.
	** @view_name content view yang akan di render.
	** @params : array. adalah parameter yang akan di sertakan ke dalam view content
	** @layout : string
	*/
	public static function renderAjax($view_name, $params = array(), $layout = 'default')
	{
		$view_content = self::$ci->load->view($view_name, $params, TRUE); 

		self::$ci->load->view($view_name, $params);
	}


	public static function setFlashMessage($item = 'result', $value = null)
	{
		// return self::$ci->session->set_flashdata($item, $value);
	}

	public static function CreateAlert($type ='alert-dark', $message = 'Input message', $flash_item = false)
	{
		$output = '<div class="alert '.$type.' alert-dismissible fade show" role="alert">';
			$output .= $message;
			$output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				$output .= '<span aria-hidden="true">&times;</span>';
			$output .= '</button>';
		$output .= '</div>';
		if($flash_item){
			return self::$ci->session->set_flashdata($flash_item, $output);
		}
		else{
			self::$_alert = $output;
			return $this;
		}

	}

	public static function GetAlert($flash_item = false)
	{
		if($flash_item){
			return self::$ci->session->flashdata($flash_item);
		}else{
			return self::$_alert;
		}
	}

	public function __destruct()
	{

	}



}
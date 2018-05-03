<?php

Class Breadcrumb
{
	/* Nama class : Breadcrumb
	** deskripsi : digunakan untuk memudahkan membuat breadcrumb dengan bootsrap
	*/

	private $_instance = null;
	public $label = [];
	public $url	 = [];

	/*Constructor*/
	public function __construct()
	{
		
	}

	/* perintah untuk membuat bradcrumb
	** @params : array()
	** @return : string
	*/
	public static function create($params = [])
	{

		$output = '<nav aria-label="breadcrumb">';
		$output .= '<ol class="breadcrumb">';
		if(!$params)
		{
			die('Missing parameters. Breadcrumb::create([label => $label, url => $url])');
		}else {
			foreach ($params as $item => $val) {
				$url = null;
				if(array_key_exists('url', $val)){
					$url = $val['url'];
				}

				if(array_key_exists('label', $val)){
					$output .= '<li class="breadcrumb-item">';
						if($url){
							$output .= '<a href="' .$url. '" class="ajax-link">';
						}
						$output .= $val['label'];
						if($url){
							$output .= '</a>';
						}
					$output .= '</li>';
				}

			}
		}

		$output .= '</ol>';
		$output .= '</nav>';

		echo $output;
	}
}

// Breadcrumb::create(['label' => 'asdas', 'url' => $url]);
// Breadcrumb::create(['label' => 'asdas', 'url' => $url]);
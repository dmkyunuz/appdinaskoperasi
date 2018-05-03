<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

if(!function_exists('current_time')){
	function current_time($format){
		$current_time = date('Y-m-d H:i:s');
		if($format == 'strtotime') : 
			return strtotime($current_time);
		else :
			return $current_time;
		endif;
		
	}
}

if(!function_exists('current_date')){
	function current_date($format){
		$current_date = date('Y-m-d H:i:s');
		if($format == 'strtotime') : 
			return strtotime($current_date);
		else :
			return $current_time;
		endif;
	}
}

if(! function_exists('Dateid')){

	function Dateid($date, $fomat = []){
		$date = date('Y-m-d H:i:s', $date);
		$date = explode(" ", $date);
		$date_array = explode("-", $date[0]);

		$year = $date_array[0];
		$month = $date_array[1];
		$tanggal = $date_array[2];
		if($year == 'Y') {
			$year = $year;
		}

		if($month == 'm'){
			$month = $month;
		}else{
			switch ($month) {
				case '1':
					$month = 'Januari';
				break;
				
				case '2':
					$month = 'Januari';
				break;
				
				case '3':
					$month = 'Januari';
				break;
				
				case '4':
					$month = 'Januari';
				break;
				
				case '5':
					$month = 'Januari';
				break;
				
				case '6':
					$month = 'Januari';
				break;
				
				case '7':
					$month = 'Januari';
				break;
				
				case '8':
					$month = 'Januari';
				break;
				
				case '9':
					$month = 'Januari';
				break;
				
				case '10':
					$month = 'Januari';
				break;
				
				case '11':
					$month = 'Januari';
				break;
				
				case '12':
					$month = 'Januari';
				break;
				
				default:
					$month = $month;
				break;
			}
		}

		return $tanggal ."-". $month ."-". $year. " " .$date[1];
	}
}
if(! function_exists('Dateen')){

	function Dateen($date){

	}
}
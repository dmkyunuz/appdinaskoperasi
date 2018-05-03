<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mytasksmd Extends CI_Model
{
	CONST table = 'tasks';





	public function generateId()
	{
		
        return current_time('strtotime') . strtoupper(hash('crc32b',UNIQID()));	
	}
}
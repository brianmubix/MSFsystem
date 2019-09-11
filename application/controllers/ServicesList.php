<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesList extends CI_Controller {

	
	public function index()
	{
		$this->load->view('Services/servicelist_view');
	}
}

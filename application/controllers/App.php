<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function index()
	{
		$data['title'] = "Twitch Manager";
		$data['nav'] = "Home";
		$this->load->view('header', $data);
		$this->load->view('footer');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
        }

	public function index()
	{

		$this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('templates/mainbody');
                $this->load->view('templates/footer');
                //$this->load->view('my_message');
	}
}

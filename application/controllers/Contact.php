<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->helper('utility_helper');
        }

	public function index()
	{

		$this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('contact/index');
                $this->load->view('templates/footer');
                //$this->load->view('my_message');
	}
}

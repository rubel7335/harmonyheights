<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->helper('utility_helper');
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                redirect('login');
            }
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

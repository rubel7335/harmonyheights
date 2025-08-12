<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('branch_model');
            $this->load->model('category_model');
            $this->load->model('designation_model');
            $this->load->helper('url_helper');
            $this->load->database("db_pension_mgm");
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                redirect('login');
            }
        }


	public function index()
	{
            $data['branches'] = $this->branch_model->get_branches();
            $data['usercategories'] = $this->category_model->get_categories();
            $data['designations'] = $this->designation_model->get_designations();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('register/index', $data);
            $this->load->view('templates/footer');
	}

}
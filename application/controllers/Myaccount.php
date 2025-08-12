<?php
class Myaccount extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('myaccount_model');
       // $this->load->model('fi_model');
        $this->load->library('session');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }

    public function index()
    {
        $data['appuser'] = $this->myaccount_model->get_appuser($id);
        $data['title'] = 'User Information';         
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('myaccount/index', $data);
        $this->load->view('templates/footer');           
    }
 
    public function view($id = NULL)
    {
        $id = $this->uri->segment(3); 
        if (empty($id))
        {
            show_404();
        }

            $data['appuser'] = $this->myaccount_model->get_appuser($id);      
            //print_r($data);

            $data['title'] = $data['appuser']['fullname']; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('myaccount/index', $data);
            $this->load->view('templates/footer');

    }
    
}
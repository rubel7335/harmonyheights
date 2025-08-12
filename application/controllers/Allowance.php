<?php

class Allowance extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('branch_model');
        $this->load->model('employee_model');
        $this->load->model('allowance_model');        
        $this->load->model('fi_model');
        $this->load->model('category_model');
        $this->load->model('designation_model');
        $this->load->helper('url_helper');     
        //print_r($this->session->userdata());    
        $is_loggedIn = $this->session->userdata('username');
        $user_cat = $this->session->userdata('usercat');
        $pages = $this->session->userdata('pages');
        //print_r($pages);
        if(empty($is_loggedIn)){
            redirect('login');
        }

    }
 
    public function index()
    {
       
        $data['allowances']  = $this->allowance_model->get_allowances_all();
        $data['title'] = 'Allowances archive'; 
        //$allowed_pages = $this->session->userdata('pages');
        //print_r($data);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('allowance/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['allowance_item']  = $this->allowance_model->get_allowances_all($id);
        if (empty($data['allowance_item']))
        {
            show_404();
        } 
        $data['title'] = $data['allowance_item']['allowance_type']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('allowance/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {

            
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add an Allowance';
        //$data['allowances']  = $this->allowance_model->get_allowances();
                            
        $this->form_validation->set_rules('allowance_type', 'Allowance Type', 'required');
        $this->form_validation->set_rules('allowance_amount', 'Allowance Amount', 'required');
        $this->form_validation->set_rules('gross_or_percentage', 'Gross or Percentage', 'required');   
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('allowance/create', $data);
            $this->load->view('templates/footer'); 
        }
        else
        {
            $this->allowance_model->set_allowance();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('allowance/success');
            $this->load->view('templates/footer');
        }
    }
    
    public function edit()
    {
        $id = base64_decode($this->uri->segment(3));
        
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit an Allowance'; 
        $data['allowances']  = $this->allowance_model->get_allowances();
        $data['allowance_item'] = $this->allowance_model->get_allowance_by_id($id);    
                            
        $this->form_validation->set_rules('allowance_type', 'Allowance Type', 'required');
        $this->form_validation->set_rules('allowance_amount', 'Allowance Amount', 'required');
        $this->form_validation->set_rules('gross_or_percentage', 'Gross or Percentage', 'required');   
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('allowance/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->allowance_model->set_allowance($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/allowance');
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        $id = base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
                
        $allowance_item = $this->allowance_model->get_allowance_by_id($id);
        
        $this->allowance_model->delete_allowance($id);        
        redirect( base_url() . 'index.php/allowance');        
    }
}
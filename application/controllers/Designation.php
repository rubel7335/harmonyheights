<?php
class Designation extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('designation_model');
        $this->load->library('session');
        $this->load->model('grade_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['designations'] = $this->designation_model->get_designations();
        $data['title'] = 'Desigantion archive'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('designation/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['designation_item'] = $this->designation_model->get_designations($id);        
        if (empty($data['designation_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['designation_item']['title']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('designation/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new designation';
        $data['grades'] = $this->grade_model->get_grades();  
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('alias', 'Alias', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('gradeID', 'Grade', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('designation/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->designation_model->set_designations();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('designation/success');
            $this->load->view('templates/footer');
        }
    }
    
    public function edit()
    {
        $id = $this->uri->segment(3);
        $id = base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a designation';        
        $data['designation_item'] = $this->designation_model->get_designation_by_id($id);
        $data['grades'] = $this->grade_model->get_grades();
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('alias', 'Alias', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('gradeID', 'Grade', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('designation/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->designation_model->set_designations($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/designation');
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
                
        $news_item = $this->news_model->get_news_by_id($id);
        
        $this->news_model->delete_news($id);        
        redirect( base_url() . 'index.php/news');        
    }
}
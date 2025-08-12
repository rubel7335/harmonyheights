<?php
class Grade extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
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
        $data['grades'] = $this->grade_model->get_grades();
        $data['title'] = 'Grade archive'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('grade/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['grade_item'] = $this->grade_model->get_grades($id);        
        if (empty($data['grade_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['grade_item']['title']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('grade/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new grade';
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('active_inactive', 'Status', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('grade/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->grade_model->set_grade();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('grade/success');
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
        
        $data['title'] = 'Edit a grade';        
        $data['grade_item'] = $this->grade_model->get_grade_by_id($id);
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('active_inactive', 'Status', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('grade/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->grade_model->set_grade($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/grade');
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
                
        $grade_item = $this->grade_model->get_grade_by_id($id);
        
        $this->grade_model->delete_grade($id);        
        redirect( base_url() . 'index.php/grade');        
    }
}
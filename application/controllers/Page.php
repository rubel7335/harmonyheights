<?php
class Page extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->library('session');
        $this->load->library('session');
        $this->load->model('page_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['pages'] = $this->page_model->get_pages();
        $data['title'] = 'Page archive'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('page/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['page_item'] = $this->page_model->get_pages($id);        
        if (empty($data['page_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['page_item']['name']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('page/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new page';
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url_controller', 'URL Controller', 'required');
        $this->form_validation->set_rules('url_action', 'URL Action', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('page/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->page_model->set_page();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('page/success');
            $this->load->view('templates/footer');
        }
    }
    
    public function edit()
    {
        $id = $this->uri->segment(3);
        $id = base64_decode($id);
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a page';        
        $data['page_item'] = $this->page_model->get_page_by_id($id);
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url_controller', 'URL Controller', 'required');
        $this->form_validation->set_rules('url_action', 'URL Action', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('page/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->page_model->set_page($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/page');
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
                
        $news_item = $this->page_model->get_page_by_id($id);
        
        $this->page_model->delete_page($id);        
        redirect( base_url() . 'index.php/page');        
    }
}
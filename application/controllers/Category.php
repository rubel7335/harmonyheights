<?php
class Category extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('category_model');
        $this->load->library('session');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        //print_r($pages);
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['categories'] = $this->category_model->get_categories();
        $data['title'] = 'User category archive'; 
        $this->load->view('templates/header');        
        $this->load->view('templates/menu');
        $this->load->view('category/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $id= base64_decode($id);
        $data['category_item'] = $this->category_model->get_categories($id);        
        if (empty($data['category_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['category_item']['category_name']; 
        $this->load->view('templates/header');        
        $this->load->view('templates/menu');
        $this->load->view('category/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new category';
 
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('remarks', 'remarks', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');            
            $this->load->view('templates/menu');            
            $this->load->view('category/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->category_model->set_category();
            $this->load->view('templates/header');            
            $this->load->view('templates/menu');
            $this->load->view('category/success');
            $this->load->view('templates/footer');
        }
    }
    
    public function edit()
    {
        $id = $this->uri->segment(3);
        $id= base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a category';        
        $data['category_item'] = $this->category_model->get_category_by_id($id);
        
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('remarks', 'remarks', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');            
            $this->load->view('templates/menu');
            $this->load->view('category/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->category_model->set_category($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/category');
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        $id= base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
                
        $news_item = $this->news_model->get_news_by_id($id);
        
        $this->news_model->delete_news($id);        
        redirect( base_url() . 'index.php/news');        
    }
}
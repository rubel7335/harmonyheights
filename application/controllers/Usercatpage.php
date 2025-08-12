<?php
class Usercatpage extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->library('session');
        $this->load->model('branch_model');
        $this->load->model('usercatpage_model');
        $this->load->model('page_model');
        $this->load->model('category_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['permissions'] = $this->usercatpage_model->get_permissions();
        $data['categories'] = $this->category_model->get_categories();
        $data['pages'] = $this->page_model->get_pages();
        $data['title'] = 'Permission archive'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('usercatpage/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
        $data['categories'] = $this->category_model->get_categories();
        $data['pages'] = $this->page_model->get_pages();
        $data['permission_item'] = $this->usercatpage_model->get_permissions($id);        
        if (empty($data['permission_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['permission_item']['id']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('usercatpage/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new permission';

        //$this->form_validation->set_rules('category', 'Category', 'required');
        //$this->form_validation->set_rules('pages', 'Pages', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        $data['usercategories'] = $this->category_model->get_categories();
        $data['pages'] = $this->page_model->get_pages();  
    
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('usercatpage/create', $data);
            $this->load->view('templates/footer'); 
        }
        else
        {
            $datatoinsert['user_category_id'] = $this->input->post('category');
            $datatoinsert['remarks'] = $this->input->post('remarks');
                foreach ($this->input->post('pages') as $attribute):
                $datatoinsert['page_id'] = $attribute;
                $this->db->insert('user_categories_pages', $datatoinsert);
                endforeach;         
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('usercatpage/success');
            $this->load->view('templates/footer');
        }
    }
    

    public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
        print_r($id);
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a permission';        
        //$this->form_validation->set_rules('page_id', 'Page', 'required');
        //$this->form_validation->set_rules('user_category_id', 'User category', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['category'] = $this->category_model->get_category_by_id($id);
        $data['pages'] = $this->page_model->get_pages();
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('usercatpage/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('user_categories_pages', $datatoupdate);
            //$this->usercatpage_model->set_branch($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/usercatpage');
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
                
        $permission_item = $this->usercatpage_model->get_permission_by_id($id);
        
        $this->usercatpage_model->delete_permission($id);        
        redirect( base_url() . 'index.php/usercatpage');        
    }
}
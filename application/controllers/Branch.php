<?php
class Branch extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('branch_model');
        $this->load->model('fi_model');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');    
        $this->load->helper('url_helper');
        $pages = $this->session->userdata('pages');
        $userID = $this->session->userdata('userID');
        $usercat = $this->session->userdata('usercat');
        $username = $this->session->userdata('username');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }

    }

    function _example_output($output = null)
    {
        $this->load->view('example.php',$output);    
    }    
    
    function test_function()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject("Branches");
        
        $crud->set_rules('branch_name','Branch Name','valid_email');
        
        $crud->set_table('branches');
        $crud->required_fields('fi_id');
        $crud->set_relation('fi_id','fis','name');
        
//        $crud->columns('customerName','phone','addressLine1','creditLimit');
//
        $output = $crud->render();
//
        $this->_example_output($output);
    }    
    
    
    
    public function index()
    {
        
        
        
                    $data['branches'] = $this->branch_model->get_branches();
                    $data['title'] = 'Branch archive';         
                    $this->load->view('templates/header');
                    $this->load->view('templates/menu');
                    $this->load->view('branch/index', $data);
                    $this->load->view('templates/footer');     
    }
 
    public function view($id = NULL)
    {
            $id = base64_decode($id);
            $data['branch_item'] = $this->branch_model->get_branches($id);        
            if (empty($data['branch_item']))
            {
                show_404();
            }

            $data['title'] = $data['branch_item']['branch_name']; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('branch/view', $data);
            $this->load->view('templates/footer');
       

    }
    
    public function create()
    {
        $pages = $this->session->userdata('pages');
        $username = $this->session->userdata('username');
        $usercat = $this->session->userdata('usercat');        
        foreach ($pages as $value) {
            if(($value['url_action']=="branch/create")){
                    $is_permitted = true;
            }
        } 
       if($is_permitted){
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new branch'; 
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('fi', 'FI', 'required');
        $this->form_validation->set_rules('fax_num', 'Fax', 'required');
        $this->form_validation->set_rules('tel_num', 'Telephone', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['fis'] = $this->fi_model->get_fis();
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');    
            $this->load->view('templates/menu');
            $this->load->view('branch/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->branch_model->set_branch();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('branch/success');
            $this->load->view('templates/footer');
        }
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
        
        $data['title'] = 'Edit a branch';        
        $data['branch_item'] = $this->branch_model->get_branch_by_id($id);
        
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('fax_num', 'Fax', 'required');
        $this->form_validation->set_rules('tel_num', 'Telephone', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['fis'] = $this->fi_model->get_fis();    
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('branch/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->branch_model->set_branch($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/branch');
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
                
        $branch_item = $this->branch_model->get_branch_by_id($id);
        
        $this->branch_model->delete_branch($id);        
        redirect( base_url() . 'index.php/branch');        
    }
    
    
}
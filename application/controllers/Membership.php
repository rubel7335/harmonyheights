<?php
class Membership extends CI_Controller {
 
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
        // $this->load->model('branch_model');
            $this->load->model('user_model');
            $this->load->library('session');
        //  $this->load->model('fi_model');
            $this->load->model('category_model');
            $this->load->model('membership_model');
            $this->load->helper('url_helper');
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                redirect('login');
            }
        }
 
    public function index()
    {            
            $data['members']  = $this->membership_model->get_members();
        //   $data['designations'] = $this->designation_model->get_designations();
            $data['categories'] = $this->category_model->get_categories();
        //    $data['branches'] = $this->branch_model->get_branches();
            $data['title'] = 'User archive'; 
        // print_r($data['members']);
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('membership/index', $data);
            $this->load->view('templates/footer');
        }
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['user_item'] = $this->membership_model->get_users($id);        
        if (empty($data['user_item']))
        {
            show_404();
        }
       
        $data['categories'] = $this->category_model->get_categories();
        $data['title'] = $data['user_item']['fullname']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('membership/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new user';
        
        $data['usercategories'] = $this->category_model->get_categories();
        $data['persons'] = $this->membership_model->get_persons();
       /// $data['users'] = $this->user_model->get_users();
        
        
                    
        //$this->form_validation->set_rules('username', 'Username', 'required');
        //$this->form_validation->set_rules('password', 'Password', 'required');
        
        $this->form_validation->set_rules('personal_id', 'personal id', 'required');        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[12]',array('required' => 'You must provide a valid %s.'));
      //  $this->form_validation->set_rules('fullname', 'Full Name', 'required');
      //  $this->form_validation->set_rules('flat_no', 'flat no', 'required');
      //  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
       // $this->form_validation->set_rules('contact_no', 'contact_no', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]|callback_valid_pass');
        $this->form_validation->set_rules('user_cat_id', 'user cat id', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('membership/create', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->membership_model->set_user();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('membership/success');
            $this->load->view('templates/footer');
        }
    }
    function valid_pass() {            
        $inputPassword = $this->input->post('password');
        $this->form_validation->set_message('valid_pass','Password is not valid'); 
        if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $inputPassword))
            return FALSE;
        return TRUE;
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
        
        $data['title'] = 'Edit a User';        
        $data['user_item'] = $this->membership_model->get_user($id);
       // var_dump($data['user_item'] );
       // $data['branches'] = $this->branch_model->get_branches();
        $data['usercategories'] = $this->category_model->get_categories();
       // $data['designations'] = $this->designation_model->get_designations();
        $data['persons'] = $this->membership_model->get_persons();
        //var_dump($data['persons'] );                   
        $this->form_validation->set_rules('personal_id', 'personal id', 'required');        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[12]',array('required' => 'You must provide a valid %s.'));
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('flat_no', 'flat no', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_no', 'contact_no', 'required');
     //   $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]|callback_valid_pass');
        $this->form_validation->set_rules('user_cat_id', 'user cat id', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('membership/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->membership_model->set_user($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/membership');
        }
    }
    public function reset()
    {
        $id = $this->uri->segment(3);
        $id = base64_decode($id);        
        if (empty($id))
        {
            show_404();
        }
        $data['user_item'] = $this->membership_model->get_users($id);    
        
        $username = $this->session->userdata('username');        
        $user_item = $this->membership_model->get_user_by_id($id);    
        
        $this->membership_model->reset_user($id);        
        redirect( base_url() . 'index.php/membership');        
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3); 
        $id = base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
                
        $user_item = $this->user_model->get_user_by_id($id);        
        $this->user_model->delete_user($id);        
        redirect( base_url() . 'index.php/user');        
    }
}
<?php
class Expensecatpage extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->library('session');
      //  $this->load->model('expensecatpage_model');
        $this->load->model('expense_model');
        $this->load->model('expense_subarea_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
        $data['all_expenses']  = $this->expense_model->get_all_expenses();  
        $data['expense_expensecategories']  = $this->expense_model->get_all_expense_subarea();   
        //var_dump($data['all_expenses']);
        $data['title'] = 'Expense category,subcategory'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('expensecatpage/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($id = NULL)
    {
            $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
            $data['all_expenses']  = $this->expense_model->get_all_expenses(); 
            $data['expense_expensecategory']  = $this->expense_model->get_all_expense_subarea($id);  
            
        // var_dump($data['expense_expensecategories']);
            if (empty($data['expense_expensecategory']))
            {
                show_404();
            }
            
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expensecatpage/view', $data);
            $this->load->view('templates/footer');
        }
    
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Assign expense to expense category';

        $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
        $data['all_expenses']  = $this->expense_model->get_all_expenses(); 
        $data['expense_expensecategories']  = $this->expense_model->get_all_expense_subarea(); 
       

       // echo $datatoinsert['expense_subarea_id'] = $this->input->post('category');
       // echo $datatoinsert['remarks'] = $this->input->post('remarks');

        
        $this->form_validation->set_rules('category', 'Category', 'required');
     //   $this->form_validation->set_rules('expenses', 'Expenses', 'required');
      //  $this->form_validation->set_rules('remarks', 'Remarks', 'required');
     
    
        if ($this->form_validation->run() === FALSE)
        {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('expensecatpage/create', $data);
                $this->load->view('templates/footer'); 
            }
        else
            {
            $datatoinsert['expense_subarea_id'] = $this->input->post('category');
                    $datatoinsert['remarks'] = $this->input->post('remarks');
                    foreach ($this->input->post('expenses') as $attribute):
                        $datatoinsert['expense_id'] = $attribute;
                        $this->db->insert('expense_expensecategories', $datatoinsert);
                    endforeach;    
                    redirect('expensecatpage', 'refresh');   

            }
    }
    public function update(){
        $expense_subarea_ids = $this->input->post('expense_subarea_ids');
        $expense_ids = $this->input->post('expense_ids');
        $selected_expenses = $this->input->post('expense_ids');
        var_dump($selected_expenses );

// Use $expense_subarea_ids, $expense_ids, and $selected_expenses as needed in your update logic.

    }

    public function expensecatexchange(){
        $this->load->helper('form');
        $this->load->library('form_validation');        
        $data['title'] = 'Edit an assignment';        
        $data['expense_categories'] = $this->expense_model->get_all_expsubarea();
        $data['all_expenses'] = $this->expense_model->get_all_expenses();

            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expensecatpage/dragdrop', $data);
            $this->load->view('templates/footer');

    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
      //  print_r($id);
        $this->load->helper('form');
        $this->load->library('form_validation');        
        $data['title'] = 'Edit an assignment';        
        $data['expense_categories'] = $this->expense_model->get_all_expsubarea();
        $data['all_expenses'] = $this->expense_model->get_all_expenses();
       // $data['selected_expense_cat'] = $this->expense_model->get_all_expense_subarea($id); 


      //  var_dump($data['selected_expense_cat']);
  


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expensecatpage/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('user_categories_pages', $datatoupdate);
            redirect( base_url() . 'index.php/usercatpage');
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        // echo "Selected ID:".$id;
        
        if (empty($id))
        {
            show_404();
        }
                
        
        $expense_expensecategory  = $this->expense_model->get_all_expense_subarea($id);       
        $affected_rows = $this->expense_model->delete_assignment($id);  
        //var_dump($expense_expensecategory); 
        if($affected_rows > 0){ 
            redirect('expensecatpage', 'refresh');

            }
            else {
                // The delete query failed or no rows were affected
                echo "Failed to delete assignment.";
            }

            
    }
}
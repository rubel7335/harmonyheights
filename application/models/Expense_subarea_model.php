<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_subarea_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Create a new expense subarea
    public function create($data) {
        $this->db->insert('expense_subarea', $data);
    }

    // Read a single expense subarea by ID
    public function read($expense_subarea_id) {
        $query = $this->db->get_where('expense_subarea', array('id' => $expense_subarea_id));
        return $query->row();
    }

    // Read all expense subareas
    public function read_all() {
        $expense_area_id=1;
        $query = $this->db->get_where('expense_subarea', array('expense_area_id' => $expense_area_id));
        return $query->result();
    }

    // Update an existing expense subarea
    public function update($data, $expense_area_id) {
        $this->db->where('id', $expense_area_id);
        $this->db->update('expense_subarea', $data);
    }

    // Delete an expense subarea by ID
    public function delete($expense_area_id) {
        $this->db->where('expense_area_id', $expense_area_id);
        $this->db->delete('expense_subarea');
    }
}
?>

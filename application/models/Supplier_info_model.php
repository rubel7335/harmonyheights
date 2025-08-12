<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_info_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Create a new supplier
    public function create($data) {
        $this->db->insert('supplier_info', $data);
        return $this->db->insert_id();
    }

    // Read a single supplier by ID
    public function read($id) {
        return $this->db->get_where('supplier_info', array('id' => $id))->row();
    }

    // Read all suppliers
    public function read_all() {
        return $this->db->get('supplier_info')->result();
    }

    // Update an existing supplier
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('supplier_info', $data);
    }

    // Delete a supplier by ID
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('supplier_info');
    }
}
?>

<?php
class Notice_model extends CI_Model {
    // Function to insert a new notice
    public function insert_notice($data) {
        return $this->db->insert('notices', $data);
    }
 
    // Function to fetch all notices
    public function get_notices() {
        return $this->db->get('notices')->result_array();
    }

    // Function to fetch a single notice by ID
    public function get_notice_by_id($id) {
        return $this->db->get_where('notices', array('id' => $id))->row_array();
    }

    // Function to update a notice by ID
    public function update_notice($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('notices', $data);
    }

    // Function to delete a notice by ID
    public function delete_notice($id) {
        return $this->db->delete('notices', array('id' => $id));
    }
}

<?php
class Fund_transfer_model extends CI_Model {

    public function create($data) {
        $this->db->insert('fund_transfer', $data);
        return $this->db->insert_id();
    }

    public function read($id = null) {
        if ($id) {
            return $this->db->get_where('fund_transfer', array('id' => $id))->row();
        } else {
            return $this->db->get('fund_transfer')->result();
        }
    }

    public function get_cash_withdraw_by_id($id){
        $query = $this->db->get_where('fund_transfer', array('reciever_id' => $id));
        return $query->result();
    }


    public function get_total_cash_withdraw($recieve_by_person_id = false){
        $this->db->select('reciever_id, SUM(amount) as total_amount_withdraw')
        ->from('fund_transfer');

        if ($recieve_by_person_id !== false) {
            $this->db->where('reciever_id', $recieve_by_person_id);
            }
        $this->db->group_by('reciever_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function read_currentbalance($id = null) {
        if ($id) {
            return $this->db->get_where('balance', array('id' => $id))->row();
        } else {
            return $this->db->get('balance')->result();
        }
    }
    

    public function checkIfdataExists($personalID){
    //  echo   "Personal ID:".$personalID;
     
                $this->db->where('personal_id', $personalID);
                $query = $this->db->get('balance');

                if ($query->num_rows() > 0) {
                    return true; // Row with the specific ID exists
                } else {
                    return false; // Row with the specific ID does not exist
                }
        
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('fund_transfer', $data);
    }

    public function delete($id) {
        $this->db->delete('fund_transfer', array('id' => $id));
    }
}

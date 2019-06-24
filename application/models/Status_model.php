<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_Model extends CI_Model {

    // Load database
	public function __construct() {
		parent::__construct();
		$this->load->database();
    }

    public function getStatus()
    {
        return $this->db->get('status');
    }
    
    private function autoIncrement()
    {
        $this->db->select_max('kode_status');
        $data = $this->db->get('status')->row_array();
        return $data['kode_status']+1;
    }

    // public function detail($id) {
    //     $this->db->select('*');
    //     $this->db->from('status');
    //     $this->db->where('id_status',$id);
    //     $this->db->order_by('kode_status','ASC');
    //     $query = $this->db->get();
    //     return $query->row();
    // }

    // public function get()
    // {
    //     $query = $this->db->get('status');
    //     return $query->result_array();
    //     // return $query->row();
    // }

    public function create()
    {
        $kode = $this->autoIncrement();
        $i = $this->input;
        $data = [
            'kode_status' => $kode,
            'status' => $i->post('status')
        ];
        return $this->db->insert('status', $data);
    }

    public function update($id)
    {
        $data = array(
            'id_status' => $id,
            'status'      => $this->input->post('status')
        );
        $this->db->where('id_status',$data['id_status']);
        // $this->db->where('id_status', $id);
        return $this->db->update('status', $data);
    }

    public function delete($id)
    {
        $data = [
            'id_status' => $id
        ];
        $this->db->where('id_status',$data['id_status']);
        return $this->db->delete('status');
    }

    //Listing
    public function listing() {
        $this->db->select('*');
        $this->db->from('status');
        $this->db->order_by('id_status','ASC');
        $query = $this->db->get();
        return $query->result();
    }

}

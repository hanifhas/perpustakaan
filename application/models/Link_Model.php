<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_Model extends CI_Model {

	// Load database
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

  //Listing
  public function listing() {
    $this->db->select('*');
    $this->db->from('link');
    $this->db->order_by('id_link','ASC');
    $query = $this->db->get();
    return $query->result();
  }

	// Tambah
	public function tambah ($data) {
		$this->db->insert('link',$data);
	}

  public function detail($id_link) {
    $this->db->select('*');
    $this->db->from('link');
    $this->db->where('id_link',$id_link);
    $this->db->order_by('id_link','ASC');
    $query = $this->db->get();
    return $query->row();
  }

  // Edit
  public function edit ($data) {
    $this->db->where('id_link',$data['id_link']);
    $this->db->update('link',$data);
  }

  // Delete
	public function delete ($data){
		$this->db->where('id_link',$data['id_link']);
		$this->db->delete('link',$data);
	}

}

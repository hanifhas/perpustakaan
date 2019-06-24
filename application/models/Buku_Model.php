<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_Model extends CI_Model {

	// Load database
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

  //Listing
  public function listing() {
    $this->db->select('buku.*,
                      jenis.nama_jenis,
                      jenis.kode_jenis,
                      bahasa.nama_bahasa,
                      bahasa.kode_bahasa,
                      user.nama
                      ');
    $this->db->from('buku');
    //JDin 4 table
    $this->db->join('jenis','jenis.id_jenis = buku.id_jenis','LEFT');
    $this->db->join('bahasa','bahasa.id_bahasa = buku.id_bahasa','LEFT');
    $this->db->join('user','user.id_user = buku.id_user','LEFT');
    //end join
    $this->db->order_by('id_buku','ASC');
    $query = $this->db->get();
    return $query->result();
  }

	//Buku
  public function buku() {
    $this->db->select('buku.*,
                      jenis.nama_jenis,
                      jenis.kode_jenis,
                      bahasa.nama_bahasa,
                      bahasa.kode_bahasa,
                      user.nama
                      ');
    $this->db->from('buku');
    //JDin 4 table
    $this->db->join('jenis','jenis.id_jenis = buku.id_jenis','LEFT');
    $this->db->join('bahasa','bahasa.id_bahasa = buku.id_bahasa','LEFT');
    $this->db->join('user','user.id_user = buku.id_user','LEFT');
    //end join
		$this->db->where(array(	'buku.status_buku' => 'Publish'));
    $this->db->order_by('id_buku','ASC');
		// $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }

	//Buku Baru
  public function buku_baru() {
    $this->db->select('buku.*,
                      jenis.nama_jenis,
                      jenis.kode_jenis,
                      bahasa.nama_bahasa,
                      bahasa.kode_bahasa,
                      user.nama
                      ');
    $this->db->from('buku');
    //JDin 4 table
    $this->db->join('jenis','jenis.id_jenis = buku.id_jenis','LEFT');
    $this->db->join('bahasa','bahasa.id_bahasa = buku.id_bahasa','LEFT');
    $this->db->join('user','user.id_user = buku.id_user','LEFT');
    //end join
		$this->db->where(array(	'buku.status_buku' => 'Publish'));
    $this->db->order_by('id_buku','DESC');
		$this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }

	//cari buku
  public function cari($keywords) {
    $this->db->select('buku.*,
                      jenis.nama_jenis,
                      jenis.kode_jenis,
                      bahasa.nama_bahasa,
                      bahasa.kode_bahasa,
                      user.nama
                      ');
    $this->db->from('buku');
    //JDin 4 table
    $this->db->join('jenis','jenis.id_jenis = buku.id_jenis','LEFT');
    $this->db->join('bahasa','bahasa.id_bahasa = buku.id_bahasa','LEFT');
    $this->db->join('user','user.id_user = buku.id_user','LEFT');
    //end join
		$this->db->where(array(	'buku.status_buku' => 'Publish'));
		$this->db->like('buku.judul_buku',$keywords);
    $this->db->order_by('id_buku','DESC');
		// $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }

	//detail buku
  public function detaill($id_buku) {
    $this->db->select('buku.*,
                      jenis.nama_jenis,
                      jenis.kode_jenis,
                      bahasa.nama_bahasa,
                      bahasa.kode_bahasa,
                      user.nama
                      ');
    $this->db->from('buku');
    //JDin 4 table
    $this->db->join('jenis','jenis.id_jenis = buku.id_jenis','LEFT');
    $this->db->join('bahasa','bahasa.id_bahasa = buku.id_bahasa','LEFT');
    $this->db->join('user','user.id_user = buku.id_user','LEFT');
    //end join
		$this->db->where(array(	'buku.status_buku' => 'Publish',
														'id_buku' => $id_buku
													));
    $this->db->order_by('id_buku','DESC');
		// $this->db->limit(4);
    $query = $this->db->get();
    return $query->row();
  }

	// Tambah
	public function tambah ($data) {
		$this->db->insert('buku',$data);
	}

  public function detail($id_buku) {
    $this->db->select('*');
    $this->db->from('buku');
    $this->db->where('id_buku',$id_buku);
    $this->db->order_by('id_buku','ASC');
    $query = $this->db->get();
    return $query->row();
  }

  // Edit
  public function edit ($data) {
    $this->db->where('id_buku',$data['id_buku']);
    $this->db->update('buku',$data);
  }

  // Delete
	public function delete ($data){
		$this->db->where('id_buku',$data['id_buku']);
		$this->db->delete('buku',$data);
	}

	public function login($bukuname, $password) {
		$this->db->select('*');
		$this->db->from('buku');
		$this->db->where(array('bukuname'		=> $bukuname,
													 'password'  	=> sha1($password)
										));
		$this->db->order_by('id_buku','DESC');
		$query = $this->db->get();
		return $query->row();
	}

}

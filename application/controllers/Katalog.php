<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

  public function __construct(){
		parent::__construct();
    $this->load->model('berita_model');
    $this->load->model('buku_model');
    $this->load->model('jenis_model');
    $this->load->model('bahasa_model');
    $this->load->model('file_model');
		$this->load->model('link_model');

	}

	public function index()
	{
		// $site = $this->home_model->listing();
		$buku	= $this->buku_model->buku();
		// $new	= $this->produk_model->new();
		// $berita = $this->berita_model->berita();
		// $slide = $this->berita_model->slide();

    $valid = $this->form_validation;
    $valid->set_rules('cari','Keywords','required',
                array('required' => 'Keywords harus diisi' ));

    if($valid->run()){
      $cari = strip_tags($this->input->post('cari'));
      $keywords = str_replace(' ','-',$cari);
      redirect(base_url('katalog/cari/'.$keywords),'refresh');
    }

    $data = array('title'  			=> 'Katalog Buku',//$site['namaweb'].' | '.$site['tagline']
									// 'produk'			=> $produk,
									// 'new'					=> $new,
                  'buku'  		  => $buku,
									// 'berita'  		=> $berita,
									// 'slide'  			=> $slide,
                  'isi'    			=> 'katalog/list');

    $this->load->view('layout/file',$data,FALSE);
	}

  public function cari($keywords)
	{
		// $site = $this->home_model->listing();
    $keywords = str_replace(' ','-',strip_tags($keywords));
    $buku	= $this->buku_model->cari($keywords);
		// $new	= $this->produk_model->new();
		// $berita = $this->berita_model->berita();
		// $slide = $this->berita_model->slide();


    $data = array('title'  			=> 'Hasil Pencarian "'.$keywords.'" ('.count($buku).')',//$site['namaweb'].' | '.$site['tagline']
									// 'produk'			=> $produk,
									// 'new'					=> $new,
                  'buku'  		  => $buku,
                  'keywords'  	=> $keywords,
									// 'berita'  		=> $berita,
									// 'slide'  			=> $slide,
                  'isi'    			=> 'katalog/cari');

    $this->load->view('layout/file',$data,FALSE);
	}

  public function detail($id_buku)
	{
    // $keywords = str_replace(' ','-',strip_tags($keywords));
    $bukus	= $this->buku_model->buku_baru();
    $buku	= $this->buku_model->detaill($id_buku);
    $file	= $this->file_model->buku($id_buku);

    $data = array('title'  			=> $buku->judul_buku,//$site['namaweb'].' | '.$site['tagline']
									// 'produk'			=> $produk,
									// 'new'					=> $new,
                  'buku'  		  => $buku,
                  'bukus'  		  => $bukus,
                  'file'  		  => $file,
                  // 'keywords'  	=> $keywords,
									// 'berita'  		=> $berita,
									// 'slide'  			=> $slide,
                  'judul'       => 'Detail Buku',
                  'isi'    			=> 'katalog/detail');

    $this->load->view('layout/file',$data,FALSE);
	}

  public function read($id_file)
	{
    // $keywords = str_replace(' ','-',strip_tags($keywords));
    $bukus	= $this->buku_model->buku_baru();
    $file	= $this->file_model->detail($id_file);
    $id_buku = $file->id_buku;
    $buku	= $this->buku_model->detaill($id_buku);

    $data = array('title'  			=> $buku->judul_buku.' - '.$file->judul_file,
									// 'produk'			=> $produk,
									// 'new'					=> $new,
                  'buku'  		  => $buku,
                  'bukus'  		  => $bukus,
                  'file'  		  => $file,
                  // 'keywords'  	=> $keywords,
									// 'berita'  		=> $berita,
									// 'slide'  			=> $slide,
                  'judul'       => 'Detail Buku',
                  'isi'    			=> 'katalog/read');

    $this->load->view('layout/file',$data,FALSE);
  }
  
  public function pinjam()
  {
    // $anggota = $this->anggota_model->detailAnggota($id);
    // $peminjaman = $this->peminjaman_model->anggota($id);
    // $buku = $this->buku_model->listing();
    // $konfigurasi = $this->konfigurasi_model->listing();
    // $limit = $this->peminjaman_model->limit_peminjaman_anggota($id);

    // $valid = $this->form_validation;
    // $valid->set_rules('id_buku','Pilih judul buku', 'required',
    //                 array('required' => 'Pilih judul buku' ));

    // if ($valid->run() == FALSE) {

    // $data = array(
    //     'title' => 'Peminjaman Buku ',
    //     'anggota' => $anggota,
    //     'peminjaman' => $peminjaman,
    //     'buku' => $buku,
    //     'konfigurasi' => $konfigurasi,
    //     'limit' => $limit,
    //     'isi' => 'admin/peminjaman/add',
    // );
    // $this->load->view('layout/file', $data, false);
    // }else {
    // $i = $this->input;
    // $data = array(
    //     // 'id_user' => $this->session->userdata('id_user'),
    //     'id_user' => $id,
    //     'id_buku ' => $i->post('id_buku'),
    //     // 'id_anggota' => $id,
    //     'tanggal_pinjam'  => $i->post('tanggal_pinjam'),
    //     'tanggal_kembali'  => $i->post('tanggal_kembali'),
    //     'keterangan'  => $i->post('keterangan'),
    //     // 'status_kembali'  => $i->post('status_kembali')
    //     'status_kembali'  => 'Belum'
    // );
    // $this->peminjaman_model->tambah($data);
    // $this->session->set_flashdata(
    //     'pesan',
    //     '<div class="alert alert-success" role="alert">
    //         Data Peminjaman Telah ditambahkan
    //     </div>'
    // );
    // redirect(base_url('peminjaman/add/'.$id),'refresh');
    // }

    $data = [
      'title'  			=> 'Pinjam Buku',
      'isi' => 'katalog/peminjaman'
    ];
    $this->load->view('layout/file', $data, FALSE);
    

  }

  public function bayar()
  {
    $data = [
      'title'  			=> 'Bayar Buku',
      'isi' => 'katalog/pembayaran'
    ];
    $this->load->view('layout/file', $data, FALSE);
  }

}

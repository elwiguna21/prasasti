<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_front extends CI_Model {
 
   
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
   
 
    function getbanner()
    {
        $query = $this->db->get('banner');
        return $query->result();
    }

    function getbanner1()
    {
        $this->db->order_by('id','desc');
        $this->db->limit('1');
        $query = $this->db->get('banner');
        return $query->result();
    }
    
    function getberita()
    {
        $this->db->limit('10');
        $query = $this->db->get('berita');
        return $query->result();
    }

    function getberitaall()
    {
        $this->db->order_by('tanggal','DESC');
        $query = $this->db->get('berita');
        return $query->result();
    }

    function getartikelall()
    {
        $this->db->order_by('tanggal','DESC');
        $query = $this->db->get('artikel');
        return $query->result();
    }

    function getperaturan()
    {
        $this->db->order_by('id','DESC');
        $query = $this->db->get('peraturan');
        return $query->result();
    }
    
    function getartikel()
    {
        $this->db->limit('10');
        $query = $this->db->get('artikel');
        return $query->result();
    }
    
    function getfaq()
    {
        $query = $this->db->get('faq');
        return $query->result();
    }
    
    function getprofil()
    {
        $query = $this->db->get('profil');
        return $query->result();
    }

    function getlink()
    {
        $this->db->limit('5');
        $query = $this->db->get('link');
        return $query->result();
    }

    function getdata($tabel,$slug)
    {
        $this->db->where('slug',$slug);
        $query = $this->db->get($tabel);
        return $query->result();
    }

    function getcountarsip()
    {
        $this->db->select('COUNT(id) as total');
        return $this->db->get('berkas')->result();
    }

    function getcountskpd()
    {
        $this->db->select('COUNT(id_skpd) as total');
        return $this->db->get('skpd')->result();
    }

    function getgaleri()
    {
        $this->db->limit('5');
        $query = $this->db->get('galeri');
        return $query->result();
    }
 

}
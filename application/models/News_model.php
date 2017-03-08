<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getNews($count)
    {
        $this->db->from('news');
        $this->db->where(array('view_flg' => '1'));
        $this->db->order_by('ins_date', 'DESC');
        $this->db->limit($count, 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllNews()
    {
        
        return;
    }
}

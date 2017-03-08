<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_categories_big_all()
    {
        $this->db->from('categories_big');
        $this->db->order_by('big_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_categories_med($big_id)
    {
        $this->db->from('categories_medium');
        $this->db->where(array('big_id' => $big_id));
        $this->db->order_by('med_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_categories_sml($big_id,$med_id)
    {
        $this->db->from('categories_small');
        $this->db->where(array('big_id' => $big_id, 'med_id' => $med_id));
        $this->db->order_by('sml_id');
        $query = $this->db->get();
        return $query->result();
    }
}

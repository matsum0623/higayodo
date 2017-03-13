<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAllArea()
    {
        $this->db->from('areas');
        $this->db->order_by('area_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_areas_all()
    {
        $this->db->from('areas');
        $this->db->order_by('area_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_area_name_from_id($area_id)
    {
        $this->db->from('areas');
        $this->db->where('area_id',$area_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->area_name;
    }
}

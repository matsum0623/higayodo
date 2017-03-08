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
}

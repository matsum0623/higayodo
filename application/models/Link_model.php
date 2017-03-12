<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_links_all()
    {
		$query = $this->db->get("links");
		return $query->result();	

	}
}

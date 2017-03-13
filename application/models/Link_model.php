<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * linksテーブルモデル
 */
class Link_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * リンク一覧の取得
     */
    public function get_links_all()
    {
		$query = $this->db->get("links");
		return $query->result();	

	}
}

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
	
	public function regist($data)
	{
	    $data['reg_time'] = date('Y/m/d H:i:s');
	    $this->db->set($data);
	    $this->db->insert('links');
	}
	
	public function update($id,$data)
	{
	    $this->db->where('id',$id);
	    $this->db->set($data);
	    $this->db->update('links');
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->set('del_time',date('Y/m/d H:i:s'));
		$this->db->update('links');
	}
}

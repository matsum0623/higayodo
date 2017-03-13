<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * newsテーブルモデル
 */
class News_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 表示フラグの立っている新着情報一覧を取得
     */
    public function getNews($count)
    {
        $this->db->from('news');
        $this->db->where(array('view_flg' => '1'));
        $this->db->order_by('ins_date', 'DESC');
        $this->db->limit($count, 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * 全ての新着情報を取得
     */
    public function getAllNews()
    {
        return;
    }
}

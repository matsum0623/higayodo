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
    public function get_news($limit,$offset)
    {
        $this->db->order_by('ins_date', 'DESC');
        $this->db->limit($limit,$offset);
        $query = $this->db->get('news');
        return $query->result();
    }
    /**
     * 全ての新着情報を取得
     */
    public function getAllNews()
    {
        
        return;
    }
    public function regist($text)
    {
        $this->db->set('text',$text);    
        $this->db->set('view_flg','1');
        $this->db->set('ins_date',date('Y/m/d H:i:s'));
        $this->db->insert('news');
    }
    public function update($id,$text)
    {
        $this->db->where('id',$id);
        $this->db->set('text',$text);
        $this->db->set('upd_date',date('Y/m/d H:i:s'));
        $this->db->update('news');
    }
    public function get_news_count()
    {
        return $this->db->count_all_results('news');
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->set('del_date',date('Y/m/d H:i:s'));
        $this->db->set('view_flg','0');
        $this->db->update('news');
    }
}

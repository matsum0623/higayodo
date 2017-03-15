<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categoriesテーブルモデル
 */
class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 大分類一覧の取得
     */
    public function get_categories_big_all()
    {
        $this->db->from('categories_big');
        $this->db->order_by('big_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * IDを指定して大分類名称の取得
     */
    public function get_category_big_name_from_id($big_id)
    {
        $this->db->from('categories_big');
        $this->db->where('big_id',$big_id);
        $query = $this->db->get();
        $result = $query->row();
        if(count($result) == 0){
            return '';
        }else{
            return $result->big_name;
        }
    }

    /**
     * 中分類一覧の取得
     */
    public function get_categories_med($big_id)
    {
        $this->db->from('categories_medium');
        $this->db->where(array('big_id' => $big_id));
        $this->db->order_by('med_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * IDを指定して中分類名称を取得
     */
    public function get_category_med_name_from_id($big_id,$med_id)
    {
        $this->db->from('categories_medium');
        $this->db->where('big_id',$big_id);
        $this->db->where('med_id',$med_id);
        $query = $this->db->get();
        $result = $query->row();
        if(count($result) == 0){
            return '';
        }else{
            return $result->med_name;
        }
    }
    
    /**
     * 小分類一覧の取得
     */
    public function get_categories_sml($big_id,$med_id)
    {
        $this->db->from('categories_small');
        $this->db->where(array('big_id' => $big_id, 'med_id' => $med_id));
        $this->db->order_by('sml_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * IDを指定して小分類名称の取得
     */
    public function get_category_sml_name_from_id($big_id,$med_id,$sml_id)
    {
        $this->db->from('categories_small');
        $this->db->where('big_id',$big_id);
        $this->db->where('med_id',$med_id);
        $this->db->where('sml_id',$sml_id);
        $query = $this->db->get();
        $result = $query->row();
        if(count($result) == 0){
            return '';
        }else{
            return $result->sml_name;
        }
    }
}

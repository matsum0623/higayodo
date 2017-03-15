<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categoriesテーブルモデル
 */
class Category_model extends CI_Model {

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
    
    public function get_categories_med_all()
    {
        $this->db->from('categories_big');
        $this->db->join('categories_medium','categories_big.big_id = categories_medium.big_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_categories_sml_all()
    {
        $this->db->from('categories_big');
        $this->db->join('categories_medium','categories_big.big_id = categories_medium.big_id');
        $this->db->join('categories_small','categories_big.big_id = categories_small.big_id AND categories_medium.med_id = categories_small.med_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function check_category_big($big_id,$big_name)
    {
        $this->db->where('big_id',$big_id);
        $query = $this->db->get('categories_big');
        $res = $query->row();
        if(count($res) == 0){
            return 'new';
        }elseif($res->big_name <> $big_name){
            return 'conflict';
        }
    }
    public function regist_category_big($big_id,$big_name)
    {
        $this->db->set(array(
                'big_id' => $big_id,
                'big_name' => $big_name,
            ));
        $this->db->insert('categories_big');
    }
    public function check_category_med($big_id,$med_id,$med_name)
    {
        $this->db->where(array('big_id'=>$big_id,'med_id'=>$med_id));
        $query = $this->db->get('categories_medium');
        $res = $query->row();
        if(count($res) == 0){
            return 'new';
        }elseif($res->med_name <> $med_name){
            return 'conflict';
        }
    }
    public function regist_category_med($big_id,$med_id,$med_name)
    {
        $this->db->set(array(
                'big_id' => $big_id,
                'med_id' => $med_id,
                'med_name' => $med_name,
            ));
        $this->db->insert('categories_medium');
    }    
    public function check_category_sml($big_id,$med_id,$sml_id,$sml_name)
    {
        $this->db->where(array('big_id'=>$big_id,'med_id'=>$med_id,'sml_id'=>$sml_id));
        $query = $this->db->get('categories_small');
        $res = $query->row();
        if(count($res) == 0){
            return 'new';
        }elseif($res->sml_name <> $sml_name){
            return 'conflict';
        }
    }
    public function regist_category_sml($big_id,$med_id,$sml_id,$sml_name)
    {
        $this->db->set(array(
                'big_id' => $big_id,
                'med_id' => $med_id,
                'sml_id' => $sml_id,
                'sml_name' => $sml_name,
            ));
        $this->db->insert('categories_small');
    }
    public function update_big_name($big_id,$big_name)
    {
        $this->db->where('big_id',$big_id);
        $this->db->set('big_name',$big_name);
        $this->db->update('categories_big');
    }
    public function update_med_name($big_id,$med_id,$med_name)
    {
        $this->db->where('big_id',$big_id);
        $this->db->where('med_id',$med_id);
        $this->db->set('med_name',$med_name);
        $this->db->update('categories_medium');
    }
    public function update_sml_name($big_id,$med_id,$sml_id,$sml_name)
    {
        $this->db->where('big_id',$big_id);
        $this->db->where('med_id',$med_id);
        $this->db->where('sml_id',$sml_id);
        $this->db->set('sml_name',$sml_name);
        $this->db->update('categories_small');
    }
}

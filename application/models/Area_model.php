<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * areasテーブルモデル
 */
class Area_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 全てのエリア情報を取得
     */
    public function getAllArea()
    {
        $this->db->from('areas');
        $this->db->order_by('area_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * 全てのエリア情報を取得
     */
    public function get_areas_all()
    {
        $this->db->from('areas');
        $this->db->order_by('area_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * ID指定してエリア名称を取得
     */
    public function get_area_name_from_id($area_id)
    {
        $this->db->from('areas');
        $this->db->where('area_id',$area_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->area_name;
    }
    
    /**
     * KEY指定してエリアIDを取得
     */
    public function get_area_id_from_key($area_key)
    {
        $this->db->from('areas');
        $this->db->where('area_key',$area_key);
        $query = $this->db->get();
        $result = $query->row();
        return $result->area_id;
    }
    
    /**
     * エリア一覧のアップデート
     */
    public function update_area($area_id,$area_key,$area_name)
    {
        $this->db->where('area_id',$area_id);
        $this->db->set('area_key',$area_key);
        $this->db->set('area_name',$area_name);
        $this->db->update('areas');
    }
    
    public function regist($area_key,$area_name)
    {
        $this->db->set(array(
                'area_key' => $area_key,
                'area_name' => $area_name
            ));
        $this->db->insert('areas');
    }

    public function delete($area_id)
    {
        $this->db->where('area_id',$area_id);
        $this->db->delete('areas');
    }

}

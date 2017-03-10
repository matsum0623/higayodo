<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spot_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getSpots($area,$big_id,$med_id,$sml_id,$like,$free_word,$page)
    {
        $this->db->from('spots');
        $this->db->join('areas', 'spots.area_id = areas.area_key');
        $this->db->join('categories_big', 'spots.big_id = categories_big.big_id');
        $this->db->join('categories_medium', 'CONCAT(spots.big_id,spots.med_id) = CONCAT(categories_medium.big_id,categories_medium.med_id)');
        $this->db->join('categories_small', 'CONCAT(spots.big_id,spots.med_id,spots.sml_id) = CONCAT(categories_small.big_id,categories_small.med_id,categories_small.sml_id)');
        if($area <> ''){
            $this->db->where(array('spots.area_id' => $area));
        }
        if($big_id <> ''){
            $this->db->where(array('spots.big_id' => $big_id));
        }
        if($med_id <> ''){
            $this->db->where(array('spots.med_id' => $med_id));
        }
        if($sml_id <> ''){
            $this->db->where(array('spots.sml_id' => $sml_id));
        }
        if(count($free_word) <> 0){
            $this->db->group_start();
            for($i=0;$i<count($free_word);$i++){
                if($i==0){
                    $this->db->like('spots.name', $free_word[$i]);
                }else{
                    $this->db->or_like('spots.name', $free_word[$i]);
                }
            }
            $this->db->group_end();
        }
        $this->db->order_by('id');
        $this->db->limit(10,($page-1)*10);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getSpotsCount($area,$big_id,$med_id,$sml_id,$like,$free_word)
    {
        $this->db->from('spots');
        if($area <> ''){
            $this->db->where(array('area_id' => $area));
        }
        if($big_id <> ''){
            $this->db->where(array('big_id' => $big_id));
        }
        if($med_id <> ''){
            $this->db->where(array('med_id' => $med_id));
        }
        if($sml_id <> ''){
            $this->db->where(array('sml_id' => $sml_id));
        }
        if(count($free_word) <> 0){
            $this->db->group_start();
            for($i=0;$i<count($free_word);$i++){
                if($i==0){
                    $this->db->like('name', $free_word[$i]);
                }else{
                    $this->db->or_like('name', $free_word[$i]);
                }
            }
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }
    
    public function getSpotFromId($id)
    {
        if($id == '' or $id == null){
            return false;
        }
        $this->db->from('spots');
        $this->db->join('areas', 'spots.area_id = areas.area_key');
        $this->db->join('categories_big', 'spots.big_id = categories_big.big_id');
        $this->db->join('categories_medium', 'CONCAT(spots.big_id,spots.med_id) = CONCAT(categories_medium.big_id,categories_medium.med_id)');
        $this->db->join('categories_small', 'CONCAT(spots.big_id,spots.med_id,spots.sml_id) = CONCAT(categories_small.big_id,categories_small.med_id,categories_small.sml_id)');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}

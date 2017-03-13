<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct(){
    
        parent::__construct();
    }

	public function get_med_categories()
	{
        if($this->input->post()){
            $big_id = $this->input->post('big_id');

            $this->load->model('Categories_model');
            $med_cate_data = $this->Categories_model->get_categories_med($big_id);
            
            $res = array();
            foreach($med_cate_data as $row){
                $res[] = array(
                    'med_id'   => $row->med_id,
                    'med_name' => $row->med_name
                );
            }
            
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($res));
        }
    }
    
	public function get_sml_categories()
	{
        if($this->input->post()){
            $big_id = $this->input->post('big_id');
            $med_id = $this->input->post('med_id');

            $this->load->model('Categories_model');
            $aml_cate_data = $this->Categories_model->get_categories_sml($big_id,$med_id);
            
            $res = array();
            foreach($aml_cate_data as $row){
                $res[] = array(
                    'sml_id'   => $row->sml_id,
                    'sml_name' => $row->sml_name
                );
            }
            
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($res));
        }
     }}

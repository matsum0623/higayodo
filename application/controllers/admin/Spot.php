<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理者専用ページ
 */
class Spot extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('login');
    	}
        $data['title'] = '管理者専用 / 東淀川区 地域情報データベース';
        $data['page'] = 'admin';
        $this->load->vars($data);
    }

	public function index()
	{
        $this->load->model('Area_model');
        $data['areas'] = $this->Area_model->get_areas_all();
        
        $this->load->model('Categories_model');
        $data['categories_big'] = $this->Categories_model->get_categories_big_all();
        
        $this->load->view('admin/spot_regist_view',$data);
	}
	
    /**
     * 施設新規登録
     */
    public function regist()
    {
        if( ! $this->input->post()){
			redirect('admin/home');
        }
        
        $data['name'] = $this->input->post('name');
        $data['name_kana'] = $this->input->post('name_kana');
        $data['area_id'] = $this->input->post('area_id');
        $this->load->model('Area_model');
        $data['area_name']  = $this->Area_model->get_area_name_from_id($data['area_id']);
        $data['big_id'] = $this->input->post('big_id');
        $data['med_id'] = $this->input->post('med_id');
        $data['sml_id'] = $this->input->post('sml_id');
        $this->load->model('Categories_model');
        $data['big_name']   = $this->Categories_model->get_category_big_name_from_id($data['big_id']);
        $data['med_name']   = $this->Categories_model->get_category_med_name_from_id($data['big_id'],$data['med_id']);
        $data['sml_name']   = $this->Categories_model->get_category_sml_name_from_id($data['big_id'],$data['med_id'],$data['sml_id']);
        $data['address'] = $this->input->post('address');
        $data['open_time'] = $this->input->post('open_time');
        $data['close_time'] = $this->input->post('close_time');
        $data['closed'] = $this->input->post('closed');
        $data['url'] = $this->input->post('url');
        $data['comment'] = $this->input->post('comment');

        if($this->input->post('check') == 'no'){
        	$this->load->view('admin/spot_regist_check_view',$data);
        }else{
        	$this->load->model('Spot_model');
        	$this->Spot_model->regist(array(
        			'name'       => $data['name'],
        			'name_kana'  => $data['name_kana'],
        			'area_id'    => $data['area_id'],
        			'big_id'     => $data['big_id'],
        			'med_id'     => $data['med_id'],
        			'sml_id'     => $data['sml_id'],
        			'address'    => $data['address'],
        			'open_time'  => $data['open_time'],
        			'close_time' => $data['close_time'],
        			'closed'     => $data['closed'],
        			'url'        => $data['url'],
        			'comment'    => $data['comment'],
        			'reg_time' => date('Y/m/d H:i:s')
        		));
    		redirect('admin/spot');
        }
    }
}

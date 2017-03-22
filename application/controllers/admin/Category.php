<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理者専用ページ
 */
class Category extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('login');
    	}
        $data['title'] = '管理者専用 / 東淀川区 地域情報データベース';
        $data['page'] = 'admin';
        $this->load->vars($data);
        
        $this->load->model('Category_model');
    }

	public function index($view = 'big')
	{
	    $data['categories_big'] = $this->Category_model->get_categories_big_all();
	    $data['categories_med'] = $this->Category_model->get_categories_med_all();
	    $data['categories_sml'] = $this->Category_model->get_categories_sml_all();
        
        switch($view){
            case 'big':
                $data['big_view'] = '';
                $data['med_view'] = 'none';
                $data['sml_view'] = 'none';
                break;
            case 'med':
                $data['big_view'] = 'none';
                $data['med_view'] = '';
                $data['sml_view'] = 'none';
                break;
            case 'sml':
                $data['big_view'] = 'none';
                $data['med_view'] = 'none';
                $data['sml_view'] = '';
                break;
            default :
                $data['big_view'] = '';
                $data['med_view'] = 'none';
                $data['sml_view'] = 'none';
        }
        
        $this->load->view('admin/category_view',$data);
	}
	public function update()
	{
		if( ! $this->input->post()){
			redirect('home');
		}
		$flg = $this->input->post('flg');
		echo $flg;
		if($flg == 'big'){
		    $big_id = $this->input->post('big_id');
		    $big_name = $this->input->post('big_name');
		    
		    $this->Category_model->update_big_name($big_id,$big_name);
		    
		    redirect('admin/category/index/big');
		}elseif($flg == 'med'){
		    $big_id = $this->input->post('big_id');
		    $med_id = $this->input->post('med_id');
		    $med_name = $this->input->post('med_name');

		    $this->Category_model->update_med_name($big_id,$med_id,$med_name);
		    
		    redirect('admin/category/index/med');
		}elseif($flg == 'sml'){
		    $big_id = $this->input->post('big_id');
		    $med_id = $this->input->post('med_id');
		    $sml_id = $this->input->post('sml_id');
		    $sml_name = $this->input->post('sml_name');

		    $this->Category_model->update_sml_name($big_id,$med_id,$sml_id,$sml_name);
		    
		    redirect('admin/category/index/sml');
		}else{
		    redirect('admin/category');
		}
	}
	
	public function regist()
	{
		if( ! $this->input->post()){
			redirect('home');
		}
		$big_id   = $this->input->post('big_id');
		$big_name = $this->input->post('big_name');
		$med_id   = $this->input->post('med_id');
		$med_name = $this->input->post('med_name');
		$sml_id   = $this->input->post('sml_id');
		$sml_name = $this->input->post('sml_name');
		
        // 大分類のチェック
        $check_big = $this->Category_model->check_category_big($big_id,$big_name);
        if($check_big == 'new'){
            $this->Category_model->regist_category_big($big_id,$big_name);
        }elseif($check_big == 'conflict'){
            // 大分類名称のコンフリクト
        }
        // 中分類のチェック
        $check_med = $this->Category_model->check_category_med($big_id,$med_id,$med_name);
        if($check_med == 'new'){
            $this->Category_model->regist_category_med($big_id,$med_id,$med_name);
        }elseif($check_med == 'conflict'){
            // 中分類名称のコンフリクト
        }
        // 小分類のチェック
        $check_sml = $this->Category_model->check_category_sml($big_id,$med_id,$sml_id,$sml_name);
        if($check_sml == 'new'){
            $this->Category_model->regist_category_sml($big_id,$med_id,$sml_id,$sml_name);
        }elseif($check_sml == 'conflict'){
            // 中分類名称のコンフリクト
        }

		redirect('admin/category');
	}
	
	public function delete()
	{
	}
	
	public function get_big_name()
	{
	    if($this->input->post()){
	        $big_id = $this->input->post('big_id');

            $check_big = $this->Category_model->check_category_big($big_id,'');
	        $big_name = $this->Category_model->get_category_big_name_from_id($big_id);
	        
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array('check' => $check_big, 'big_name' => $big_name)));
	    }
	}
	public function get_med_name()
	{
	    if($this->input->post()){
	        $big_id = $this->input->post('big_id');
	        $med_id = $this->input->post('med_id');
	       
            $check_med = $this->Category_model->check_category_med($big_id,$med_id,'');
	        $med_name = $this->Category_model->get_category_med_name_from_id($big_id,$med_id);
	       
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array('check' => $check_med, 'med_name' => $med_name)));
	    }
	}
	public function get_sml_name()
	{
	    if($this->input->post()){
	        $big_id = $this->input->post('big_id');
	        $med_id = $this->input->post('med_id');
	        $sml_id = $this->input->post('sml_id');
	       
            $check_sml = $this->Category_model->check_category_sml($big_id,$med_id,$sml_id,'');
	        $sml_name = $this->Category_model->get_category_sml_name_from_id($big_id,$med_id,$sml_id);
	       
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array('check' => $check_sml, 'sml_name' => $sml_name)));
	    }
	}
}

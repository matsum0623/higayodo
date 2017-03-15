<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理者専用ページ
 */
class Area extends CI_Controller {

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

		$this->load->view('admin/area_view',$data);
	}
	public function update()
	{
		$data['area_id'] = $this->input->post('area_id');
		if($data['area_id'] == '' || $data['area_id'] == NULL){
			redirect('admin');
		}
		$data['area_key'] = $this->input->post('area_key');
		$data['area_name'] = $this->input->post('area_name');
		
		$this->load->model('Area_model');
		$this->Area_model->update_area($data['area_id'],$data['area_key'],$data['area_name']);
		
	    $data['areas'] = $this->Area_model->get_areas_all();

		$this->load->view('admin/area_view',$data);
	}
	
	public function regist()
	{
		if( ! $this->input->post()){
			redirect('home');
		}
		$data['area_key'] = $this->input->post('area_key');
		$data['area_name'] = $this->input->post('area_name');
		
		$this->load->model('Area_model');
		$this->Area_model->regist($data['area_key'],$data['area_name']);
		
		redirect('admin/area');
	}
	
	public function delete()
	{
		if( ! $this->input->post()){
			redirect('home');
		}
		$data['area_id'] = $this->input->post('area_id');

		$this->load->model('Area_model');
		$this->Area_model->delete($data['area_id']);

		redirect('admin/area');
	}
}

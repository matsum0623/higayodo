<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * リンク一覧管理ページ
 */
class Link extends CI_Controller {

    public function __construct()
    {
    
        parent::__construct();

    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('login');
    	}
        $data['title'] = '管理者専用 / 東淀川区 地域情報データベース';
        $data['page'] = 'admin';
        $data['message'] = '';
        $this->load->vars($data);
        
        $this->load->model('Link_model');
    }

	public function index()
	{
	    
	    $data['links'] = $this->Link_model->get_links_all();
	    
		$this->load->view('admin/link_view',$data);
	}
	
	/**
	 * リンクの登録
	 */
	public function regist()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
	    
	    $data['seq'] = $this->input->post('seq');
	    $data['name'] = $this->input->post('name');
	    $data['link'] = $this->input->post('link');
	    $data['comment'] = $this->input->post('comment');
	    
	    $this->Link_model->regist($data);
	    
		$this->go_view('登録しました');
	}
	
	/**
	 * リンクの更新
	 */
	public function update()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
	    
	    $id = $this->input->post('id');
	    
	    $data['seq'] = $this->input->post('seq');
	    $data['name'] = $this->input->post('name');
	    $data['link'] = $this->input->post('link');
	    $data['comment'] = $this->input->post('comment');
	    
		$this->Link_model->update($id,$data);
		
		$this->go_view('更新しました');
	}
	
	/**
	 * リンクの削除
	 */
	public function delete()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
		$id = $this->input->post('id');
		
		if($id == '' || $id == NULL){
			redirect('admin');
		}
		
		$this->Link_model->delete($id);
		
		$this->go_view('削除しました');
	}
	
	private function go_view($message)
	{
		$data['message'] = $message;
	    $data['links'] = $this->Link_model->get_links_all();
	    
		$this->load->view('admin/link_view',$data);

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理者専用ページ
 */
class News extends CI_Controller {

    public function __construct()
    {
    
        parent::__construct();

    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('login');
    	}
        $data['title'] = '管理者専用 / 東淀川区 地域情報データベース';
        $data['page'] = 'admin';
        $this->load->vars($data);
        
        $this->load->model('News_model');
    }

	public function index()
	{
	    $data['page'] = $this->input->get('page');
	    
        $data['news'] = $this->News_model->get_news(10,$data['page'] ? ($data['page']-1) * 10 : 0);

        // ページネーション用設定
        $this->load->library('pagination');
        $config['base_url'] = base_url()."/admin/news.html";
        $config['total_rows'] = $this->News_model->get_news_count();
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        
        $this->pagination->initialize($config);

		$this->load->view('admin/news_view',$data);
	}
	
	public function regist()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
	    $text = $this->input->post('text');
	    if($text == ''){
	        redirect('admin');
	    }
	    $this->News_model->regist($text);
	    
	    redirect('admin/news');
	}
	
	public function update()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
		$id = $this->input->post('id');
		
		if($id == '' || $id == NULL){
			redirect('admin');
		}
		$text = $this->input->post('text');
		
		$this->News_model->update($id,$text);
		
		redirect('admin/news');
	    
	}
	
	public function delete()
	{
	    if( ! $this->input->post()){
	        redirect('home');
	    }
		$id = $this->input->post('id');
		
		if($id == '' || $id == NULL){
			redirect('admin');
		}
		
		$this->News_model->delete($id);
		
		redirect('admin/news');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * トップページ
 */
class Special extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

        $data['title'] = '特集 / 東淀川区 地域情報データベース';
        $data['page'] = 'special';
        $this->load->vars($data);
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);
        $this->load->vars($data);

    }

	public function index()
	{
	    $data['id'] = $this->input->get('id');
	    
		$this->load->view('special_view',$data);

	    
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * トップページ
 */
class Home extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

        $data['title'] = '東淀川区 地域情報データベース';
        $data['page'] = 'home';
        $this->load->vars($data);
        
        $this->load->model('News_model');
    }

	public function index()
	{
	    $data['news']  = $this->News_model->getNews(10);

		$this->load->view('home_view',$data);
	}
}

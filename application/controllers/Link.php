<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * リンク一覧
 */
class Link extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);

        $data['title'] = 'リンク / 東淀川区 地域情報データベース';
        $data['page'] = 'link';
        
        $this->load->vars($data);
        
        $this->load->model('Link_model');
    }

    public function index()
    {
        $data['links'] = $this->Link_model->get_links_all();
        
        
        $this->load->view('link_view', $data);
    }
}

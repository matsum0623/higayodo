<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理者専用ページ
 */
class Home extends CI_Controller {

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
		$this->load->view('admin/index_view');
	}
}

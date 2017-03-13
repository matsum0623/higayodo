<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ユーザ専用ページ
 */
class User extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

        $data['title'] = 'ユーザー専用 / 東淀川区 地域情報データベース';
        $data['page'] = 'user';
        $this->load->vars($data);
    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('login');
    	}
    }

	public function index()
	{
		$this->load->view('user_view');
	}
}

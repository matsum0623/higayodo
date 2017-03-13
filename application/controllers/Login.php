<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ユーザページログイン
 */
class Login extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

        $data['title'] = 'LOGIN / 東淀川区 地域情報データベース';
        $data['page'] = 'ログイン';
        $this->load->vars($data);
        
        $this->load->helper('form');
    	if($this->session->userdata("is_logged_in")){
    	    redirect('user');
    	}
	}

	public function index()
	{
	    $this->load->library("form_validation");

        $this->form_validation->set_rules("user_name", "メール", "required|trim");
        $this->form_validation->set_rules("password", "パスワード", "required|md5|trim|callback_do_login");

    	if($this->form_validation->run()){
        	$data = array(
        		"user_name" => $this->input->post("user_name"),
        		"is_logged_in" => 1
        	);
        	$this->session->set_userdata($data);
    	    redirect('user');
    	}else{
    		$this->load->view('login_view');
    	}
	}
	
	/**
	 * ログイン実行
	 */
	public function do_login()
	{
    	$this->load->model("User_model");
    
    	if($this->User_model->can_log_in()){
    		return true;
    	}else{
    		$this->form_validation->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
    		return false;
    	}
	}
}

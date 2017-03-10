<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct(){
    
        parent::__construct();

        $data['title'] = 'LOGOUT / 東淀川区 地域情報データベース';
        $data['page'] = 'logout';
        $this->load->vars($data);
        
    	if( ! $this->session->userdata("is_logged_in")){
    	    redirect('home');
    	}
	}

	public function index()
	{
	    $this->session->sess_destroy();
        redirect('home');
	}
}

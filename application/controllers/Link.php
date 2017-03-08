<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $data['title'] = 'リンク / 東淀川区 地域情報データベース';
        $data['page'] = 'link';
        
        $this->load->vars($data);
    }

    public function index()
    {
        $this->load->view('link');
    }
}

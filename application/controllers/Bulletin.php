<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 掲示板
 */
class Bulletin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $data['title'] = '掲示板 / 東淀川区 地域情報データベース';
        $data['page'] = 'bulletin';
        
        $this->load->vars($data);
    }

    public function index()
    {
        $this->load->view('bulletin_view');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spot extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);

        $data['title'] = '検索 / 東淀川区 地域情報データベース';
        $data['page'] = 'search';
        
        $this->load->vars($data);
    }

    public function index()
    {

        $data['id'] = $this->input->get('id') ? $this->input->get('id') : '';
        if($data['id'] == ''){
            // ID指定がなければトップページへリダイレクト
            redirect( base_url() );
        }

        // 検索用パラメータの取得
        $data['area'] = $this->input->get('area') ? $this->input->get('area') : '';
        $data['category_big'] = $this->input->get('category_big') ? $this->input->get('category_big') : '';
        $data['category_med'] = $this->input->get('category_med') ? $this->input->get('category_med') : '';
        $data['category_sml'] = $this->input->get('category_sml') ? $this->input->get('category_sml') : '';
        $data['free_word'] = $this->input->get('free_word') ? $this->input->get('free_word') : '';
        $data['page_num'] = $this->input->get('page_num') ? $this->input->get('page_num') : '1';

        $this->load->model('Spot_model');
        $data['spot'] = $this->Spot_model->getSpotFromId($data['id']);

        $data['back_link']  = "search.html?";
        $data['back_link'] .= "area={$data['area']}";
        $data['back_link'] .= "&category_big={$data['category_big']}";
        $data['back_link'] .= "&category_med={$data['category_med']}";
        $data['back_link'] .= "&category_sml={$data['category_sml']}";
        $data['back_link'] .= "&free_word={$data['free_word']}";
        $data['back_link'] .= "&page_num={$data['page_num']}";

        $this->load->view('spot_view',$data);
    }
}

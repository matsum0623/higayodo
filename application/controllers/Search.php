<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);

        $data['title'] = '検索 / 東淀川区 地域情報データベース';
        $data['page'] = 'search';
        
        $this->load->vars($data);
        
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->load->model('Area_model');
        $data['areas'] = $this->Area_model->getAllArea();
        
        $this->load->model('Categories_model');
        $data['categories_big'] = $this->Categories_model->get_categories_big_all();
        $data['categories_med'] = "";
        $data['categories_sml'] = "";

        $data['likes'] = [
            '1' => '駅から近い',
            '2' => '安い',
            '3' => '10年以上',
            '4' => '新着',
        ];
    
        $data['area'] = '';
        $data['category_big'] = '';
        $data['category_med'] = '';
        $data['category_sml'] = '';
        $data['like'] = array();
        $data['free_word'] = '';
        $data['result'] = array();
        $data['page'] = 1;
    
        if($this->input->get()){
            $data['area'] = $this->input->get('area');
            $data['category_big'] = $this->input->get('category_big');
            if($data['category_big'] <> ""){
                $data['categories_med'] = $this->Categories_model->get_categories_med($data['category_big']);
            }
            $data['category_med'] = $this->input->get('category_med');
            if($data['category_med'] <> ""){
                $data['categories_sml'] = $this->Categories_model->get_categories_sml($data['category_big'],$data['category_med']);
            }
            $data['category_sml'] = $this->input->get('category_sml');
            $data['like'] = $this->input->get('like') ? $this->input->get('like') : array();
            $data['free_word'] = $this->input->get('free_word');
            if($this->input->get('page')){
                $data['page'] = $this->input->get('page');
            }

            $this->load->model('Spot_model');
            $data['result'] = $this->Spot_model->getSpots($data['area'],$data['category_big'],$data['category_med'],$data['category_sml'],$data['like'],explode(" ",$data['free_word']),$data['page']);
            
            // ページネーション用設定
            $config['base_url'] = base_url()."/search.html?";
            $config['base_url'] .= "area=";
            $config['base_url'] .= "&category_big=".urlencode($data['category_big']);
            $config['base_url'] .= "&category_med=".urlencode($data['category_med']);
            $config['base_url'] .= "&category_sml=".urlencode($data['category_sml']);
            $config['base_url'] .= "&free_word=".urlencode($data['free_word']);
            $config['total_rows'] = $this->Spot_model->getSpotsCount($data['area'],$data['category_big'],$data['category_med'],$data['category_sml'],$data['like'],explode(" ",$data['free_word']));;
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            
            $this->pagination->initialize($config);
        }
    
    
        $this->load->view('search',$data);
    }
    
    public function area($area_name)
    {
        $this->load->view('search');
    }
}

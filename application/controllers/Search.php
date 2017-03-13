<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 施設検索
 */
class Search extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);

        $data['title'] = '検索 / 東淀川区 地域情報データベース';
        $data['page'] = 'search';
        
        $this->load->vars($data);
        
        $this->load->library('pagination');
    }

    /**
     * 検索ページ(GETリクエスト時に施設検索)
     */
    public function index()
    {
        $this->load->model('Area_model');
        $data['areas'] = $this->Area_model->getAllArea();

        $data['area_id'] = $this->input->get('area_id') ? $this->input->get('area_id') : '';
        $data['big_id'] = $this->input->get('big_id') ? $this->input->get('big_id') : '';
        $data['med_id'] = $this->input->get('med_id') ? $this->input->get('med_id') : '';
        $data['sml_id'] = $this->input->get('sml_id') ? $this->input->get('sml_id') : '';
        $data['like'] = $this->input->get('like') ? $this->input->get('like') : array();
        $data['free_word'] = $this->input->get('free_word') ? $this->input->get('free_word') : '';
        $data['result'] = array();
        $data['page_num'] = $this->input->get('page_num') ? $this->input->get('page_num') : '1';

        // カテゴリ一覧の取得
        $this->load->model('Categories_model');
        $data['categories_big'] = $this->Categories_model->get_categories_big_all();
        if($data['big_id'] <> ""){
            $data['categories_med'] = $this->Categories_model->get_categories_med($data['big_id']);
        }
        if($data['big_id'] <> "" && $data['med_id'] <> ""){
            $data['categories_sml'] = $this->Categories_model->get_categories_sml($data['big_id'],$data['med_id']);
        }
    
        if($this->input->get()){

            $this->load->model('Spot_model');
            $data['result'] = $this->Spot_model->getSpots(
                                        $data['area_id'],
                                        $data['big_id'],
                                        $data['med_id'],
                                        $data['sml_id'],
                                        $data['like'],
                                        explode(" ",$data['free_word']),
                                        $data['page_num']
                                    );
            
            // ページネーション用設定
            $config['base_url'] = base_url()."/search.html?";
            $config['base_url'] .= "area_id=".urlencode($data['area_id']);
            $config['base_url'] .= "&big_id=".urlencode($data['big_id']);
            $config['base_url'] .= "&med_id=".urlencode($data['med_id']);
            $config['base_url'] .= "&sml_id=".urlencode($data['sml_id']);
            $config['base_url'] .= "&free_word=".urlencode($data['free_word']);
            $config['total_rows'] = $this->Spot_model->getSpotsCount(
                                            $data['area_id'],
                                            $data['big_id'],
                                            $data['med_id'],
                                            $data['sml_id'],
                                            $data['like'],
                                            explode(" ",$data['free_word'])
                                        );
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page_num';
            
            $this->pagination->initialize($config);
        }
    
    
        $this->load->view('search_view',$data);
    }
    
    /**
     * 左部分メニューからの遷移
     * エリア内施設一覧
     */
    public function area($area_key)
    {
        $this->load->model('Area_model');
        $data['areas'] = $this->Area_model->getAllArea();
        $data['area_id'] = $this->Area_model->get_area_id_from_key($area_key);

        $data['big_id'] = '';
        $data['med_id'] = '';
        $data['sml_id'] = '';
        $data['like'] = array();
        $data['free_word'] = '';
        $data['result'] = array();
        $data['page_num'] = '1';

        // カテゴリ一覧の取得
        $this->load->model('Categories_model');
        $data['categories_big'] = $this->Categories_model->get_categories_big_all();
        $data['categories_med'] = array();
        $data['categories_sml'] = array();

        $this->load->model('Spot_model');
        $data['result'] = $this->Spot_model->getSpots(
                                    $data['area_id'],
                                    $data['big_id'],
                                    $data['med_id'],
                                    $data['sml_id'],
                                    $data['like'],
                                    explode(" ",$data['free_word']),
                                    $data['page_num']
                                );
            
        // ページネーション用設定
        $config['base_url'] = base_url()."/search.html?";
        $config['base_url'] .= "area_id=".urlencode($data['area_id']);
        $config['base_url'] .= "&big_id=".urlencode($data['big_id']);
        $config['base_url'] .= "&med_id=".urlencode($data['med_id']);
        $config['base_url'] .= "&sml_id=".urlencode($data['sml_id']);
        $config['base_url'] .= "&free_word=".urlencode($data['free_word']);
        $config['total_rows'] = $this->Spot_model->getSpotsCount(
                                        $data['area_id'],
                                        $data['big_id'],
                                        $data['med_id'],
                                        $data['sml_id'],
                                        $data['like'],
                                        explode(" ",$data['free_word'])
                                    );
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page_num';
        
        $this->pagination->initialize($config);
        $this->load->view('search_view',$data);
    }
}

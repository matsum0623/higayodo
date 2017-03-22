<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 施設詳細
 */
class Spot extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('News_model');
	    $data['news']  = $this->News_model->getNews(10);

        $data['title'] = '検索 / 東淀川区 地域情報データベース';
        $data['page'] = 'search';
        
        $this->load->vars($data);

        $this->load->model('Spot_model');
    }

    /**
     * 施設詳細の表示
     */
    public function index()
    {
        $data['id'] = $this->input->get('id') ? $this->input->get('id') : '';
        if($data['id'] == ''){
            // ID指定がなければトップページへリダイレクト
            redirect( base_url() );
        }

        // 検索用パラメータの取得
        $data['area_id'] = $this->input->get('area_id') ? $this->input->get('area_id') : '';
        $data['category_big'] = $this->input->get('category_big') ? $this->input->get('category_big') : '';
        $data['category_med'] = $this->input->get('category_med') ? $this->input->get('category_med') : '';
        $data['category_sml'] = $this->input->get('category_sml') ? $this->input->get('category_sml') : '';
        $data['free_word'] = $this->input->get('free_word') ? $this->input->get('free_word') : '';
        $data['page_num'] = $this->input->get('page_num') ? $this->input->get('page_num') : '1';

        $data['spot'] = $this->Spot_model->getSpotFromId($data['id']);

        $data['back_link']  = "search.html?";
        $data['back_link'] .= "area_id={$data['area_id']}";
        $data['back_link'] .= "&category_big={$data['category_big']}";
        $data['back_link'] .= "&category_med={$data['category_med']}";
        $data['back_link'] .= "&category_sml={$data['category_sml']}";
        $data['back_link'] .= "&free_word={$data['free_word']}";
        $data['back_link'] .= "&page_num={$data['page_num']}";

        $this->load->view('spot_view',$data);
    }
    
    /**
     * 施設情報編集
     */
    public function edit()
    {
        if( ! $this->session->userdata("is_logged_in")){
            redirect('home');
        }
        $data['id'] = $this->input->get('id') ? $this->input->get('id') : '';
        $data['spot'] = $this->Spot_model->getSpotFromId($data['id']);
        
        $this->load->model('Area_model');
        $data['areas'] = $this->Area_model->get_areas_all();
        
        $this->load->model('Categories_model');
        $data['categories_big'] = $this->Categories_model->get_categories_big_all();
        if($data['spot']->big_id <> ''){
            $data['categories_med'] = $this->Categories_model->get_categories_med($data['spot']->big_id);
        }
        if($data['spot']->big_id <> '' && $data['spot']->med_id <> ''){
            $data['categories_sml'] = $this->Categories_model->get_categories_sml($data['spot']->big_id,$data['spot']->med_id);
        }
        
        $this->load->view('spot_edit_view',$data);
    }
    
    /**
     * 施設情報アップデート
     */
    public function update()
    {
        if( ! $this->session->userdata("is_logged_in")){
            redirect('home');
        }
        $data['id'] = $this->input->post('id');
        $test = $this->input->post('test');
        if($data['id'] == '' || $data['id'] == NULL){
            redirect('home');
        }
        $data['name']       = $this->input->post('name');
        $data['name_kana']  = $this->input->post('name_kana');
        $data['area_id']    = $this->input->post('area_id');
        $this->load->model('Area_model');
        $data['area_name']  = $this->Area_model->get_area_name_from_id($data['area_id']);
        $data['big_id']     = $this->input->post('big_id');
        $data['med_id']     = $this->input->post('med_id');
        $data['sml_id']     = $this->input->post('sml_id');
        $this->load->model('Categories_model');
        $data['big_name']   = $this->Categories_model->get_category_big_name_from_id($data['big_id']);
        $data['med_name']   = $this->Categories_model->get_category_med_name_from_id($data['big_id'],$data['med_id']);
        $data['sml_name']   = $this->Categories_model->get_category_sml_name_from_id($data['big_id'],$data['med_id'],$data['sml_id']);
        $data['address']    = $this->input->post('address');
        $data['open_time']  = $this->input->post('open_time');
        $data['close_time'] = $this->input->post('close_time');
        $data['closed']     = $this->input->post('closed');
        $data['url']        = $this->input->post('url');
        $data['comment']        = $this->input->post('comment');

        if($this->input->post('check') == 'yes'){
            $this->load->model('Spot_model');
            // update発行
            $update_data = array(
                'name' => $data['name'],
                'name_kana' => $data['name_kana'],
                'area_id' => $data['area_id'],
                'big_id' => $data['big_id'],
                'med_id' => $data['med_id'],
                'sml_id' => $data['sml_id'],
                'address' => $data['address'],
                'open_time' => $data['open_time'],
                'close_time' => $data['close_time'],
                'closed' => $data['closed'],
                'url' => $data['url'],
                'comment' => $data['comment'],
            );
            $this->Spot_model->update_spot($data['id'],$update_data);
            // spot情報取得
            $data['spot'] = $this->Spot_model->getSpotFromId($data['id']);
            $data['back_link']  = "search.html?";
            $data['back_link'] .= "area_id={$data['spot']->area_id}";
            $data['back_link'] .= "&category_big={$data['spot']->big_id}";
            $data['back_link'] .= "&category_med={$data['spot']->med_id}";
            $data['back_link'] .= "&category_sml={$data['spot']->sml_id}";
            $data['back_link'] .= "&free_word=";
            $data['back_link'] .= "&page_num=1";


            $this->load->view('spot_view',$data);
        }else{
            $this->load->view('spot_edit_check_view',$data);
        }
        
    }
}

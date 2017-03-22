<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * usersテーブルモデル
 */
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * ログイン可能かどうか判定
     */
    public function can_log_in()
    {
		$this->db->where("user_name", $this->input->post("user_name"));	//POSTされたemailデータとDB情報を照合する
		$this->db->where("password", md5($this->input->post("password")));	//POSTされたパスワードデータとDB情報を照合する
		$query = $this->db->get("users");

		if($query->num_rows() == 1){	//ユーザーが存在した場合の処理
			return true;
		}else{					//ユーザーが存在しなかった場合の処理
			return false;
		}
	}
}

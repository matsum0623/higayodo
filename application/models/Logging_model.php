<?php

class Logging_model extends CI_Model {
    
    public function __construct()
    {
        $this->db->set(array(
                'ip'       => $this->input->server('REMOTE_ADDR'),
                'agent'    => $this->input->server('HTTP_USER_AGENT'),
                'page'     => $this->input->server('REQUEST_URI'),
                'datetime' => date('Y/m/d H:i:s')
            ));
        $this->db->insert('access_log');
    }
    
    public function logging()
    {
        $this->db->set(array(
                'ip'       => $this->input->server('REMOTE_ADDR'),
                'agent'    => $this->input->server('HTTP_USER_AGENT'),
                'page'     => $this->input->server('REQUEST_URI'),
                'datetime' => date('Y/m/d H:i:s')
            ));
        $this->db->insert('access_log');
    }
    
    public function today_count()
    {
        $today = date('Y/m/d 00:00:00');
        $query = $this->db->query("
            SELECT COUNT(1) as today_count FROM (
                SELECT * FROM access_log
                    WHERE datetime >= '{$today}'
                GROUP BY ip
            ) log
        ");
        $res = $query->row();
        return $res->today_count;
    }
    
    public function yesterday_count()
    {
        $yestaday = date('Y/m/d 00:00:00',strtotime('-1 day'));
        $today    = date('Y/m/d 00:00:00');
        $query = $this->db->query("
            SELECT COUNT(1) as yesterday_count FROM (
                SELECT * FROM access_log
                    WHERE
                        datetime >= '{$yestaday}' AND
                        datetime <= '{$today}'
                GROUP BY ip
            ) log
        ");
        $res = $query->row();
        return $res->yesterday_count;
    }
    
    public function total_count()
    {
        $query = $this->db->query("
            SELECT COUNT(1) as yesterday_count FROM (
                SELECT * FROM access_log
                GROUP BY ip
            ) log
        ");
        $res = $query->row();
        return $res->yesterday_count;
    }
}
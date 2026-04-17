<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_file_description_model extends CO_Core_Model {

    protected $tableName = 'news_file_description';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $file_id) {
        $where = "file_id='$file_id'";
        return $this->insert($data, $where);
    }

    public function get_news_file_description($file_id, $lang_id = 1, $newsroom_id = '', $active = FALSE) {
        $where = "file_id='$file_id'";
        $where .= " AND language='$lang_id'";
        if ($newsroom_id != '') {
            $where .= " AND newsroom='$newsroom_id'";
        }
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function delete_file_description($file_id, $lang_id = 1, $newsroom_id = '') {
        $query = "delete from news_file_description where file_id='$file_id' AND language='$lang_id'";
        if ($newsroom_id != '') {
            $query .= " AND newsroom='$newsroom_id'";
        }
        return $this->full_query($query);
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_file_model extends CO_Core_Model {

    protected $tableName = 'news_files';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get_all_news_files($where = '') {
        return $this->select("*", $where);
    }

    public function get_news_file($id, $active = FALSE) {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function get_file($filter = array()) {
        $query = "select f.*,fd.id as description_id, fd.title as title, fd.description as description from news_files as f 
		left join news_file_description as fd on fd.file_id= f.id where f.id>0";
        if (!empty($filter['file_id'])) {
            $query .= " AND f.id='" . $filter['file_id'] . "'";
        }
        if (!empty($filter['newsroom'])) {
            $query .= " AND f.newsroom='" . $filter['newsroom'] . "'";
        }
        if (!empty($filter['active'])) {
            $query .= " AND f.active='" . $filter['active'] . "'";
        }
        if (!empty($filter['language'])) {
            $query .= " AND fd.language='" . $filter['language'] . "'";
        }
        return $this->full_query($query, TRUE);
    }

    public function get_files($filter = array()) {
        $query = "select f.*,fd.id as description_id, fd.title as title, fd.description as description from news_files as f 
		left join news_file_description as fd on fd.file_id= f.id where f.id>0";
        if (!empty($filter['newsroom'])) {
            $query .= " AND f.newsroom='" . $filter['newsroom'] . "'";
        }
        if (!empty($filter['file_id'])) {
            $query .= " AND f.id='" . $filter['file_id'] . "'";
        }
        if (!empty($filter['file_for'])) {
            $query .= " AND f.file_for='" . $filter['file_for'] . "'";
        }
        if (!empty($filter['file_type'])) {
            $query .= " AND f.file_type='" . $filter['file_type'] . "'";
        }
        if (!empty($filter['active'])) {
            $query .= " AND f.active='" . $filter['active'] . "'";
        }
        if (!empty($filter['language'])) {
            $query .= " AND fd.language='" . $filter['language'] . "'";
        }
        return $this->full_query($query);
    }

    public function delete_file($file_id) {
        if ($file_id > 0) {
            $query = "delete from news_files where id='$file_id'";
            return $this->full_query($query);
        }
    }

}

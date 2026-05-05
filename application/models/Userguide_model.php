<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Userguide_model extends CO_Core_Model {

    protected $tableName = 'userguide';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data = array(), $id = NULL) {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

    public function get_all($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        if (!empty($filter['title'])) {
            $where .= " and title LIKE '%" . $filter['title'] . "%'";
        }
        if (!empty($filter['language'])) {
            $where .= " and language='" . $filter['language'] . "'";
        }
        $order_by = " sort_order asc, id desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_all_for_panel($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "1=1";
        if (!empty($filter['title'])) {
            $where .= " AND title LIKE '%" . $filter['title'] . "%'";
        }
        if (isset($filter['language'])) {
            $where .= " AND language='" . $filter['language'] . "'";
        }
        
        $order_by = " sort_order asc, id desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_for_panel($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_parent($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function disable($id = '') {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from userguide where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }
}

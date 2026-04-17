<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Brand_model extends CO_Core_Model {

    protected $tableName = 'brand';

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
        $where=" id >0 ";
        if (!empty($filter['brand_name'])) {
            $where .= " and brand_name LIKE '%" . $filter['brand_name'] . "%'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['language'])) {
            $where .= " and language='" . $filter['language'] . "'";
        }
        if (!empty($filter['show_active_inactive'])) {
            $where .= " and active > 0 ";
        }else{
            $where .= " and active = '1'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get($id, $lang = '',$show_active_inactive='') {
        $fetch_row = TRUE;
        $where = "id='$id'";
        if($show_active_inactive){
            $where.=' and active>0';
        }else{
            $where.=" and active = '1'";
        }
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
            $where .= " or language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from brand where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

    public function check_brand_exists($name, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and brand_name='$name'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

}

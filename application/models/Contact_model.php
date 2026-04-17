<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact_model extends CO_Core_Model {

    protected $tableName = 'contact';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data = array()) {
        return $this->insert($data);
    }

    public function update($data = array(), $id = "") {
        // echo"<pre>";print_r($id);exit;
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
        if (!empty($filter['full_name'])) {
            $where .= " and full_name LIKE '%" . $filter['full_name'] . "%'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['language'])) {
            $where .= " and language='" . $filter['language'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
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

    public function get_by_lang($id, $lang = '1', $fetch_row = TRUE) {
        $where = "c.active = '1' and c.language = '1' and c.id='$id'";
        $case_columns = ", CASE WHEN lc.language='$lang' AND lc.full_name!='' THEN lc.full_name ELSE c.full_name END AS full_name";
        $case_columns .= ", CASE WHEN lc.language='$lang' AND lc.address!='' THEN lc.address ELSE c.address END AS address";
        $case_columns .= ", CASE WHEN lc.language='$lang' AND lc.work_hour!='' THEN lc.work_hour ELSE c.work_hour END AS work_hour";
        $case_columns .= ", CASE WHEN lc.language='$lang' THEN lc.language ELSE c.language END AS language";
        $case_columns .= ", CASE WHEN lc.language='$lang' THEN lc.language_parent ELSE c.language_parent END AS language_parent";
        $query = "select c.* $case_columns from $this->tableName as c
		left join $this->tableName  as lc on c.id=lc.language_parent  where " . $where;       
        return $this->full_query($query, $fetch_row);
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
        $query = "select group_concat(DISTINCT language) as languages from contact where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

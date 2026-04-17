<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_model extends CO_Core_Model {

    protected $tableName = 'distributor';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data = array()) {
        return $this->insert($data);
    }

    public function update($data = array(), $id = NULL) {
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

    public function get_by_lang($filter = array(), $lang = '1', $fetch_row = FALSE) {

        $where = "d.active = '1' and d.language = '1'";
        if (!empty($filter['id'])) {
            $where .= " and d.id='{$filter['id']}'";
        }
        if (!empty($filter['country_id'])) {
            $where .= " and d.country='{$filter['country_id']}'";
        }
        $case_columns = ", CASE WHEN ld.language='$lang' AND ld.full_name!='' THEN ld.full_name ELSE d.full_name END AS full_name";
        $case_columns .= ", CASE WHEN ld.language='$lang' AND ld.address!='' THEN ld.address ELSE d.address END AS address";
        $case_columns .= ", CASE WHEN ld.language='$lang' AND ld.city!='' THEN ld.city ELSE d.city END AS city";
        $case_columns .= ", CASE WHEN ld.language='$lang' AND ld.state!='' THEN ld.state ELSE d.state END AS state";       
        $case_columns .= ", CASE WHEN ld.language='$lang' THEN ld.language ELSE d.language END AS language";
        $case_columns .= ", CASE WHEN ld.language='$lang' THEN ld.language_parent ELSE d.language_parent END AS language_parent";
        $query = "select d.* $case_columns from $this->tableName as d
		left join $this->tableName  as ld on d.id=ld.language_parent  where " . $where;
        return $this->full_query($query, $fetch_row);
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
        $query = "select group_concat(DISTINCT language) as languages from distributor where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

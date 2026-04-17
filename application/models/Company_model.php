<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CO_Core_Model {

    protected $tableName = 'company';

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
        if (!empty($filter['company_name'])) {
            $where .= " and company_name LIKE '%" . $filter['company_name'] . "%'";
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

    public function get_by_lang($id = '', $lang = '1', $fetch_row = TRUE) {
        $where = "c.active = '1' and c.language = '1'";
        if ($id) {
            $where .= "and c.id='$id'";
        }
        $case_columns = ", CASE WHEN lc.language='$lang' AND  lc.company_name!='' THEN lc.company_name ELSE c.company_name END AS company_name";
        $case_columns .= ", CASE WHEN lc.language='$lang' AND lc.description!='' THEN lc.description ELSE c.description END AS description";
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
        $query = "select group_concat(DISTINCT language) as languages from company where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

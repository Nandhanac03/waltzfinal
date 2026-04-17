<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Other_distributor_model extends CO_Core_Model {

    protected $tableName = 'other_distributor';

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
        if (!empty($filter['category'])) {
            $where .= " and category = '". $filter['category'] . "'";
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

    public function disable($id = '') {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }
    
    public function get_by_lang($id = '', $category='', $lang = '1', $fetch_row = TRUE) {
        $where = "od.active = '1' and od.language = '1'";
        if ($id) {
            $where .= " and od.id='$id'";
        }
        if ($category) {
            $where .= " and od.category='$category'";
        }
        $case_columns = ", CASE WHEN lod.language='$lang' AND  lod.title!='' THEN lod.title ELSE od.title END AS title";  
        $case_columns .= ", CASE WHEN lod.language='$lang' AND lod.description!='' THEN lod.description ELSE od.description END AS description";
        $case_columns .= ", CASE WHEN lod.language='$lang' AND lod.link!='' THEN lod.description ELSE od.link END AS link";
        $case_columns .= ", CASE WHEN lod.language='$lang' AND lod.category!='' THEN lod.category ELSE od.category END AS category";
        $case_columns .= ", CASE WHEN lod.language='$lang' THEN lod.language ELSE od.language END AS language";
        $case_columns .= ", CASE WHEN lod.language='$lang' THEN lod.language_parent ELSE od.language_parent END AS language_parent";
        $query = "select od.* $case_columns from $this->tableName as od
		left join $this->tableName  as lod on od.id=lod.language_parent  where " . $where;
        return $this->full_query($query, $fetch_row);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from brand where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

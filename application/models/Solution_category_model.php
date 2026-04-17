<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solution_category_model extends CO_Core_Model {

    protected $tableName = "solution_category";

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get($id, $lang = 1) {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }
    public function get_for_panel($id, $lang = 1) {
        $fetch_row = TRUE;
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }
    public function get_categories($ids, $lang = 1) {
        $fetch_row = FALSE;
        $where = "active = '1'";
        if ($ids) {
            $where .= " and id in(" . $ids . ")";
        }
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_parent($id, $lang = 1) {
        $fetch_row = FALSE;
        $where = "active = '1' and parent_id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        $order_by = " category_order asc";
        return $this->select("*", $where, $fetch_row, $order_by);
    }

    public function get_by_lang($ids = '', $lang = 1, $fetch_row = false) {
        $where = "c.active = '1' and c.language = '1'";
        if ($ids) {
            $where .= " and c.id in(" . $ids . ")";
        }
        $order_by = " order by c.category_order";
        $case_columns = ", CASE WHEN lc.language='$lang' AND lc.title!='' THEN lc.title ELSE c.title END AS title";
        $case_columns .= ", CASE WHEN lc.language='$lang' AND lc.title_slug!='' THEN lc.title_slug ELSE c.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN lc.language='$lang' AND lc.description!='' THEN lc.description ELSE c.description END AS description";
        $case_columns .= ", CASE WHEN lc.language='$lang' THEN lc.language ELSE c.language END AS language";
        $case_columns .= ", CASE WHEN lc.language='$lang' THEN lc.language_parent ELSE c.language_parent END AS language_parent";
        $query = "select c.* $case_columns from $this->tableName as c
		left join $this->tableName  as lc on c.id=lc.language_parent  where " . $where . $order_by;

        return $this->full_query($query, $fetch_row);
    }

    public function get_by_lang_parent($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_all($parent_only = FALSE, $lang = 1) {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        if ($parent_only) {
            $where .= " and (parent_id='0' OR parent_id='' OR parent_id IS NULL)";
        }
        if ($lang) {
            $where .= " and language='$lang'";
        }
        $order_by = " category_order asc";
        return $this->select("*", $where, $fetch_row, $order_by);
    }
    public function get_all_for_panel($parent_only = FALSE, $lang = 1) {
        $fetch_row = FALSE;
    
        // FIX: group OR conditions
        $where = "(active = '1' OR active='0')";
    
        if ($parent_only) {
            $where .= " AND parent_id = 0";
        }
    
        if ($lang) {
            $where .= " AND language = '$lang'";
        }
    
        $order_by = "category_order ASC";
    
        return $this->select("*", $where, $fetch_row, $order_by);
    }
    
    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id, $lang = '') {
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->insert($data, $where);
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
        $query = "select group_concat(DISTINCT language) as languages from solution_category where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

    public function check_category_exists($title, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and title='$title'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function delete_category($id){
        $sql = "DELETE from solution_category where id=$id";
        return $this->full_query($sql);
    }
}

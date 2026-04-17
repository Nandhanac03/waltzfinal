<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Label_model extends CO_Core_Model {

    protected $tableName = "label";

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

    public function get_by_parent($id, $lang = 1) {
        $fetch_row = FALSE;
        $where = "active = '1' and parent_id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        $order_by = " label_order asc";
        return $this->select("*", $where, $fetch_row, $order_by);
    }

    public function get_by_lang_parent($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_all_by_lang($lang = 1) {
        $fetch_row = FALSE;
        $where = "l.active = '1' and l.language = '1'";
        $case_columns = ", CASE WHEN ll.language='$lang' AND ll.title!='' THEN ll.title ELSE l.title END AS title";
        $case_columns .= ", CASE WHEN ll.language='$lang' THEN ll.language_parent ELSE l.language_parent END AS language_parent";
        $query = "select l.* $case_columns from $this->tableName as l
		left join $this->tableName  as ll on l.id=ll.language_parent  where " . $where;
        return $this->full_query($query, $fetch_row);
    }

    public function get_all($parent_only = FALSE, $lang = 1) {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        if ($parent_only) {
            $where .= " and (parent_id='0' OR parent_id=''  OR parent_id IS NULL)";
        }
        if ($lang) {
            $where .= " and language='$lang'";
        }
        $order_by = " title asc";
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

    public function disable($id) {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from label where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page_model extends CO_Core_Model {

    protected $tableName = 'pages';

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
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['language'])) {
            $where .= " and language='" . $filter['language'] . "'";
        }
        if (!empty($filter['menu'])) {
            $where .= " and menu='" . $filter['menu'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }
    public function get_all_for_panel($filter = array(), $limit = "") {
        // echo"<pre>";print_r($filter);exit;
        $sql="select * from pages where active='1'";
        if (!empty($filter['title'])) {
            $sql .= " and title LIKE '%" . $filter['title'] . "%'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $sql .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['menu'])) {
            $sql .= " and menu='" . $filter['menu'] . "'";
        }
        
        return $this->full_query($sql);
    }

    public function get($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_for_panel($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_lang($id = '', $lang = '1', $fetch_row = TRUE) {
        $where = "p.active = '1' and p.language = '1'";
        if ($id) {
            $where .= " and p.id='$id'";
        }
        $case_columns = ", CASE WHEN lp.language='$lang' AND  lp.title!='' THEN lp.title ELSE p.title END AS title";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title_slug!='' THEN lp.title_slug ELSE p.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.subtitle!='' THEN lp.subtitle ELSE p.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.short_desc!='' THEN lp.short_desc ELSE p.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.description!='' THEN lp.description ELSE p.description END AS description";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language ELSE p.language END AS language";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language_parent ELSE p.language_parent END AS language_parent";
        $query = "select p.* $case_columns from $this->tableName as p
		left join $this->tableName  as lp on p.id=lp.language_parent  where " . $where;
        return $this->full_query($query, $fetch_row);
    }

    public function get_by_parent($language_parent, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$language_parent'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_menu($menu_id = '', $id = '', $language_parent = '', $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1'";
        if ($menu_id) {
            $where .= " and menu = '$menu_id'";
        }
        if ($id) {
            $where .= " and id = '$id'";
        }
        if ($language_parent) {
            $where .= " and language_parent = '$language_parent'";
        }
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_menu_array($menu_id = '', $id = '', $language_parent = '', $lang = '') {
        $fetch_row = FALSE;
        $where = "active = '1'";
        if ($menu_id) {
            $where .= " and menu = '$menu_id'";
        }
        if ($id) {
            $where .= " and id = '$id'";
        }
        if ($language_parent) {
            $where .= " and language_parent = '$language_parent'";
        }
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_page_title_slug($menu_id = '', $id = '', $language_parent = '', $lang = '') {
        $fetch_row = FALSE;
        $where = "active = '1'";
        if ($menu_id) {
            $where .= " and menu = '$menu_id'";
        }
        if ($id) {
            $where .= " and id = '$id'";
        }
        if ($language_parent) {
            $where .= " and language_parent = '$language_parent'";
        }
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        $order_by = " order_by asc";
        return $this->select("title,title_slug", $where, $fetch_row, $order_by);
    }

    public function get_page_content($created='') {
        $fetch_row = TRUE;
        $where = "active = '1'";
        if ($created>0) {
            $where .= " and created_at = '$created'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_content_by_slug($slug_url='') {
        $fetch_row = TRUE;
        $where = "active = '1'";
        if ($slug_url) {
            $where .= " and title_slug = '".$slug_url."'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_menu_and_id_not_in($menu_id = '', $ids = '') {
        $fetch_row = FALSE;
        $where = "active = '1'";
        if ($menu_id) {
            $where .= " and menu = '$menu_id'";
        }
        if ($ids) {
            $where .= " and id NOT IN ($ids)";
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
        $query = "select group_concat(DISTINCT language) as languages from pages where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

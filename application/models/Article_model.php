<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Article_model extends CO_Core_Model
{

    protected $tableName = 'article';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function add($data = array(), $id = NULL)
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

    public function get_all($filter = array(), $limit = "")
    {
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
        $order_by = " order_by asc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_all_for_panel($filter = array(), $limit = "")
    {

        $sql = "select * from article where 1";
        if (!empty($filter['title'])) {
            $sql .= " and title LIKE '%" . $filter['title'] . "%'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $sql .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['language'])) {
            $sql .= " and language='" . $filter['language'] . "'";
        }
        $sql .= " ORDER BY id desc";
        return $this->full_query($sql);

        // $fetch_row = FALSE;
        // $order_by = '';
        // $where = "active = '1' OR active='0'";
        // if (!empty($filter['title'])) {
        //     $where .= " and title LIKE '%" . $filter['title'] . "%'";
        // }
        // if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
        //     $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        // }
        // if (!empty($filter['language'])) {
        //     $where .= " and language='" . $filter['language'] . "'";
        // }
        // $order_by = " created_at desc";
        // return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get($id, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function get_for_panel($id, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }
    public function get_by_parent($id, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function disable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_languages($id, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT language) as languages from article where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

    public function get_by_lang($id, $lang = '1', $fetch_row = TRUE)
    {
        $where = "a.active = '1' and a.language = '1' and a.id='$id'";
        $case_columns = ", CASE WHEN la.language='$lang' AND la.title!='' THEN la.title ELSE a.title END AS title";
        $case_columns .= ", CASE WHEN la.language='$lang' AND la.title_slug!='' THEN la.title_slug ELSE a.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN la.language='$lang' AND la.subtitle!='' THEN la.subtitle ELSE a.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN la.language='$lang' AND la.short_desc!='' THEN la.short_desc ELSE a.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN la.language='$lang' AND la.description!='' THEN la.description ELSE a.description END AS description";
        $case_columns .= ", CASE WHEN la.language='$lang' THEN la.language ELSE a.language END AS language";
        $case_columns .= ", CASE WHEN la.language='$lang' THEN la.language_parent ELSE a.language_parent END AS language_parent";
        $query = "select a.* $case_columns from $this->tableName as a
		left join $this->tableName  as la on a.id=la.language_parent  where " . $where;
        return $this->full_query($query, $fetch_row);
    }
    public function get_by_slug($slug, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and title_slug='$slug'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }
    public function delete_article($id)
    {
        $sql = "DELETE from article where id=$id";
        return $this->full_query($sql);
    }
}

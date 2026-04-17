<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solution_model extends CO_Core_Model
{

    protected $tableName = 'solution';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function add($data)
    {
        return $this->insert($data);
    }

    public function update($data, $id)
    {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get_all_solution($filter = array())
    {
        $query = "select p.* from solution as p ";
        $query .= " where p.id>0 ";
        if (!empty($filter['id'])) {
            $query .= " AND p.id in(" . $filter['id'] . ")";
        }
        if (!empty($filter['category_id'])) {
            $query .= " AND p.category_id='" . $filter['category_id'] . "'";
        }

        if (!empty($filter['title'])) {
            $query .= " AND (p.title like '%" . $filter['title']  .  "%')";
        }
        
        if (!empty($filter['category'])) {
            $query .= " AND p.category='" . $filter['category'] . "'";
        }
        if (!empty($filter['from_created_at'])) {
            $query .= " AND p.created_at>='" . $filter['from_created_at'] . "'";
        }
        if (!empty($filter['to_created_at'])) {
            $query .= " AND p.created_at<='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $query .= " AND p.created_by='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['language_id'])) {
            $query .= " AND p.language='" . $filter['language_id'] . "'";
        }
        if (isset($filter['active'])) {
            if ($filter['active'] != 'all') {
                $query .= " AND p.active='" . $filter['active'] . "'";
            }
        }
        
        $query .= " order by created_at desc";
        if (isset($filter['limit'])) {
            $query .= " limit " . $filter['limit'];
        }
        return $this->full_query($query);
    }



    public function get($id, $lang = '', $active = TRUE)
    {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, TRUE);
    }


    public function get_solutions($id, $lang = '', $active = TRUE)
    {
        $where = "id in(" . $id . ")";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, FALSE);
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

    public function enable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '1';
        return $this->insert($data, $where);
    }

   

    public function get_by_slug($slug, $lang = '', $active = TRUE)
    {
        $sql = "SELECT solution.*FROM `solution` where solution.title_slug='$slug' AND solution.active='1'";
        return $this->full_query($sql);
    }

    public function delete_solution($id)
    {
        $sql = "DELETE from solution where id=$id";
        return $this->full_query($sql);
    }
    public function get_solution_without_status($id)
    {
        $sql = "select * from solution where id=$id";
        return $this->full_query($sql);
    }

    public function get_solution_by_category($category_id, $lang = 1, $active = TRUE)
    {
        $where = "category_id='$category_id'";
        $where .= " AND language='$lang'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, FALSE);
    }
}

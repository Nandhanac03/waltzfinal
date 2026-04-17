<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_model extends CO_Core_Model
{

    protected $tableName = 'candidate';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function add($data = array())
    {
        return $this->insert($data);
    }

    public function update($data = array(), $id = NULL)
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
            $where .= " and (full_name LIKE '%" . $filter['title'] . "%'";
            $where .= " or company LIKE '%" . $filter['title'] . "%'";
            $where .= " or email LIKE '%" . $filter['title'] . "%'";
            $where .= " or job_role LIKE '%" . $filter['title'] . "%'";
            $where .= " or phone LIKE '%" . $filter['title'] . "%')";
        }
        if (!empty($filter['post'])) {
            $where .= " and career_id=" . $filter['post'];
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['country'])) {
            $where .= " and country='" . $filter['country'] . "'";
        }
        if (!empty($filter['gender'])) {
            $where .= " and gender='" . $filter['gender'] . "'";
        }
        if (!empty($filter['from_exp']) && !empty($filter['to_exp'])) {
            $where .= " and experience >=" . $filter['from_exp'] . " AND experience <=" . $filter['to_exp'] . "";
        }

        if (!empty($filter['next_val'])) {
            $where .= " and id >'" . $filter['next_val'] . "'";
        }
        if (!empty($filter['prev_val'])) {
            $where .= " and id <'" . $filter['prev_val'] . "'";
        }

        if (!empty($filter['next_val'])) {
            $order_by = " created_at asc";
        } else {
            $order_by = " created_at desc";
        }

        return $this->select("*", $where, $fetch_row, $order_by, $limit);
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

    public function checkEmailExist($email, $career_id)
    {
        $fetch_row = TRUE;
        $where = " email='" . $email . "' and career_id = '$career_id' ";
        return $this->select("*", $where, $fetch_row);
    }

    public function disable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_by_job_id($id)
    {
        $sql = "select * from candidates where job_category_id=$id";
        return $this->full_query($sql);
    }

    public function delete_candidate($id)
    {
        $sql = "DELETE from candidates where id=$id";
        return $this->full_query($sql);
    }
    public function get_candidate($id){
        $sql= "SELECT * from candidates where id=$id";
        return $this->full_query($sql);
    }
}

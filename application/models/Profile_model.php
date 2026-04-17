<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CO_Core_Model
{

    protected $tableName = 'profile';

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

    public function update_by_user($data, $user_id)
    {
        $where = "user_id='$user_id'";
        return $this->insert($data, $where);
    }

    public function get_profiles($filter = array())
    {
        $where = " and u.id > 0 ";
        if (!empty($filter['email'])) {
            $where .= " and u.email LIKE '%" . $filter['email'] . "%'";
        }
        if (!empty($filter['search_user'])) {
            $where .= " and (u.email LIKE '%" . $filter['search_user'] . "%'";
            $where .= " or u.username LIKE '%" . $filter['search_user'] . "%' ";
            $where .= " or u.first_name LIKE '%" . $filter['search_user'] . "%' ";
            $where .= " or u.last_name LIKE '%" . $filter['search_user'] . "%' ";
            $where .= " or u.phone LIKE '%" . $filter['search_user'] . "%')";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and u.created_on >='" . $filter['from_created_at'] . "' AND u.created_on <='" . $filter['to_created_at'] . "'";
        }
        $order_by = " order by created_on desc";
        $query = "select p.*,u.first_name as first_name,u.last_name as last_name,
		u.email as email,u.phone as phone,u.company as company from profile as p left join users as u on p.user_id=u.id" . $where . $order_by;
        return $this->full_query($query);
    }

    public function get_profile($user_id)
    {
        $where = " where u.id='$user_id'";
        $query = "select p.*,u.first_name as first_name,u.last_name as last_name,
		u.email as email,u.phone as phone,u.company as company from profile as p left join users as u on p.user_id=u.id" . $where;
        return $this->full_query($query, true);
    }
}

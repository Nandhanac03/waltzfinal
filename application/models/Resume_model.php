<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Resume_model extends CO_Core_Model {

    protected $tableName = 'resumes';

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

    public function get($id) {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
        return $this->select("*", $where, $fetch_row);
    }

    public function get_by_parent($id) {
        $fetch_row = FALSE;
        $where = "active = '1' and parent_id='$id'";
        return $this->select("*", $where, $fetch_row);
    }

    public function disable($id = '', $parent_id = '') {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        if ($parent_id) {
            $where .= " parent_id = '" . $parent_id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

}

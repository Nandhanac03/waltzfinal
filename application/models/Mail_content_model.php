<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mail_content_model extends CO_Core_Model {

    protected $tableName = 'mail_content';

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
        if (!empty($filter['subject'])) {
            $where .= " and subject LIKE '%" . $filter['subject'] . "%'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get($id, $lang = '') {
        $fetch_row = TRUE;
        $where = "active = '1' and id='$id'";
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

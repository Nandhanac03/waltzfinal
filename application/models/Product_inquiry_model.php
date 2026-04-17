<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_inquiry_model extends CO_Core_Model {

    protected $tableName = 'product_inquiry';

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

    public function get($filter = array(), $fetch_row = FALSE, $limit = "") {
        $where = "active = '1'";
        if (!empty($filter['inquiry_id'])) {
            $where .= " and id='" . $filter['inquiry_id'] . "'";
        }
        if (!empty($filter['title'])) {
            $where .= " and title LIKE '%" . $filter['title'] . "%'";
        }
        if (!empty($filter['customer_id'])) {
            $where .= " and customer_id='" . $filter['customer_id'] . "'";
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

    public function disable($id = '') {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

}

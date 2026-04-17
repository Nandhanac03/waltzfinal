<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_order_details_model extends CO_Core_Model {

    protected $tableName = 'product_order_details';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array()) {
        $where = "active = '1'";
        if (!empty($filter['order_id'])) {
            $where .= " and order_id ='" . $filter['order_id'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and product_id ='" . $filter['product_id'] . "'";
        }
        $order_by = "created_at desc";
        return $this->select("*", $where, FALSE, $order_by);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get($id, $active = TRUE) {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

}

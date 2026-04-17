<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_order_payment_model extends CO_Core_Model {

    protected $tableName = 'product_order_payment';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array()) {
        $fetch_row = TRUE;
        $order_by = '';
        $where = "active = '1'";
        if (!empty($filter['order_id'])) {
            $where .= " and order_id ='" . $filter['order_id'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get($order_id, $active = TRUE) {
        $where = "order_id='$order_id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

}

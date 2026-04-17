<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_payment_option_model extends CO_Core_Model {

    protected $tableName = 'product_payment_option';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";       
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
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

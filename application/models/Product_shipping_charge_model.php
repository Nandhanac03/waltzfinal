<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_shipping_charge_model extends CO_Core_Model {

    protected $tableName = 'product_shipping_charge';

    public function __construct() {
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

    public function get_all() {
        $order_by = "name ASC";
        $where="active='1'";
        return $this->select('*', $where, '', $order_by);
    }

    public function get($id) {
        $where = " id='$id'";
        $where.=" and active='1'";
        return $this->select('*', $where, TRUE);
    }

}

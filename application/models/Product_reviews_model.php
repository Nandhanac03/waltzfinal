<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_reviews_model extends CO_Core_Model {

    protected $tableName = 'product_reviews';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function save($data = array(), $id = NULL) {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

    public function get($filter = array(), $fetch_row = FALSE, $limit = "") {

        $where = "active = '1'";
        if (!empty($filter['product_id'])) {
            $where .= " and product_id='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['customer_id'])) {
            $where .= " and customer_id='" . $filter['customer_id'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_customer_reviews($filter = array(), $fetch_row = FALSE, $limit = "") {

        $where = "pr.active = '1' and pr.approved='1'";
        if (!empty($filter['product_id'])) {
            $where .= " and pr.product_id='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['customer_id'])) {
            $where .= " and pr.customer_id='" . $filter['customer_id'] . "'";
        }
        $order_by = " order by pr.created_at desc";
        $query="select pr.*,u.first_name as first_name,u.last_name as last_name 
        from $this->tableName as pr left join users as u on u.id=pr.customer_id 
         where ".$where.$order_by;
        return $this->full_query($query);
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

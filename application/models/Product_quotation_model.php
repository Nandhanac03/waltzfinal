<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_quotation_model extends CO_Core_Model {

    protected $tableName = 'product_quotation';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        if (!empty($filter['customer_id'])) {
            $where .= " and customer_id ='" . $filter['customer_id'] . "'";
        }
        if (!empty($filter['quotation_ref_no'])) {
            $where .= " and quotation_ref_no ='" . $filter['quotation_ref_no'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_quotations($filter = array(), $limit = '') {
        $fetch_row = FALSE;
        $where = "pq.active = '1'";
        if (!empty($filter['customer_id'])) {
            $where .= " and pq.customer_id ='" . $filter['customer_id'] . "'";
        }
        if (!empty($filter['quotation_ref_no'])) {
            $where .= " and pq.quotation_ref_no ='" . $filter['quotation_ref_no'] . "'";
        }
        if (!empty($filter['quotation_status'])) {
            $where .= " and pq.quotation_status ='" . $filter['quotation_status'] . "'";
        }
        if (!empty($filter['from_quotationed_at']) && !empty($filter['to_quotationed_at'])) {
            $where .= " and pq.created_at >='" . $filter['from_quotationed_at'] . "' AND pq.created_at <='" . $filter['to_quotationed_at'] . "'";
        }
        $order_by = " order by pq.created_at desc";
        $sql = "select pq.*,c.first_name as first_name,c.last_name as last_name,c.email as email from product_quotation as pq
		 left join users as c on pq.customer_id=c.id where " . $where . $order_by;
        if ($limit) {
            $sql .= " limit $limit";
        }
        return $this->full_query($sql, $fetch_row);
    }

    public function get_quotation($filter = array()) {
        $fetch_row = TRUE;
        $where = "pq.active = '1'";
        if (!empty($filter['id'])) {
            $where .= " and pq.id ='" . $filter['id'] . "'";
        }
        if (!empty($filter['customer_id'])) {
            $where .= " and pq.customer_id ='" . $filter['customer_id'] . "'";
        }
        if (!empty($filter['quotation_ref_no'])) {
            $where .= " and pq.quotation_ref_no ='" . $filter['quotation_ref_no'] . "'";
        }
        if (!empty($filter['quotation_status'])) {
            $where .= " and pq.quotation_status ='" . $filter['quotation_status'] . "'";
        }
        if (!empty($filter['from_quotationed_at']) && !empty($filter['to_quotationed_at'])) {
            $where .= " and pq.created_at >='" . $filter['from_quotationed_at'] . "' AND pq.created_at <='" . $filter['to_quotationed_at'] . "'";
        }
        $sql = "select pq.*,c.first_name as first_name,c.last_name as last_name,c.email as email from product_quotation as pq
		 left join users as c on pq.customer_id=c.id where " . $where;
        return $this->full_query($sql, $fetch_row);
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

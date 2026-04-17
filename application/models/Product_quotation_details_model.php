<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_quotation_details_model extends CO_Core_Model {

    protected $tableName = 'product_quotation_details';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array()) {
        $where = "qd.active = '1'";
        if (!empty($filter['quotation_id'])) {
            $where .= " and quotation_id ='" . $filter['quotation_id'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and product_id ='" . $filter['product_id'] . "'";
        }
        $order_by = " order by created_at desc";
        $query = "select p.*,p.id as product_id,qd.id as id,qd.unit_price as quotation_unit_price,
		qd.discount as quotation_discount,qd.selling_price as quotation_selling_price,
		qd.quantity as quotation_quantity,qd.total as quotation_total
		 from product_quotation_details as qd
		left join product as p on qd.product_id=p.id where " . $where . $order_by;
        return $this->full_query($query, false);
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

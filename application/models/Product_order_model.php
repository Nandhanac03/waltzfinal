<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_order_model extends CO_Core_Model {

    protected $tableName = 'product_order';

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
        if (!empty($filter['quotation_id'])) {
            $where .= " and quotation_id ='" . $filter['quotation_id'] . "'";
        }
        if (!empty($filter['order_ref_no'])) {
            $where .= " and order_ref_no ='" . $filter['order_ref_no'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_orders($filter = array(), $limit = '') {
        $fetch_row = FALSE;
        $where = "po.active = '1'";
        if (!empty($filter['customer_id'])) {
            $where .= " and po.customer_id ='" . $filter['customer_id'] . "'";
        }
        if (!empty($filter['guest_checkout'])) {
            $where .= " and po.guest_checkout ='" . $filter['guest_checkout'] . "'";
        }
        if (!empty($filter['order_ref_no'])) {
            $where .= " and po.order_ref_no ='" . $filter['order_ref_no'] . "'";
        }
        if (!empty($filter['quotation_id'])) {
            $where .= " and po.quotation_id ='" . $filter['quotation_id'] . "'";
        }
        if (!empty($filter['order_status'])) {
            $where .= " and po.order_status ='" . $filter['order_status'] . "'";
        }
        if (!empty($filter['payment_status'])) {
            $where .= " and pop.payment_status ='" . $filter['payment_status'] . "'";
        }
        if (!empty($filter['from_ordered_at']) && !empty($filter['to_ordered_at'])) {
            $where .= " and po.created_at >='" . $filter['from_ordered_at'] . "' AND po.created_at <='" . $filter['to_ordered_at'] . "'";
        }
        $order_by = " order by po.created_at desc";
        $sql = "select po.*,c.first_name as first_name,c.last_name as last_name,c.email as email,pop.sub_total as sub_total,
		pop.vat as vat,pop.shipping_charge as shipping_charge,pop.grand_total as grand_total,pop.payment_status as payment_status,pop.payment_option as payment_option from product_order as po
		 left join users as c on po.customer_id=c.id
		 left join product_order_payment as pop on po.id=pop.order_id where " . $where . $order_by;
        if ($limit) {
            $sql .= " limit $limit";
        }
        return $this->full_query($sql, $fetch_row);
    }

    public function get_order($filter = array()) {
        $fetch_row = TRUE;
        $where = "po.active = '1'";
        if (!empty($filter['id'])) {
            $where .= " and po.id ='" . $filter['id'] . "'";
        }
        if (!empty($filter['guest_checkout'])) {
            $where .= " and po.guest_checkout ='" . $filter['guest_checkout'] . "'";
        }
        if (!empty($filter['customer_id'])) {
            $where .= " and po.customer_id ='" . $filter['customer_id'] . "'";
        }
        if (!empty($filter['order_ref_no'])) {
            $where .= " and po.order_ref_no ='" . $filter['order_ref_no'] . "'";
        }
        if (!empty($filter['quotation_id'])) {
            $where .= " and po.quotation_id ='" . $filter['quotation_id'] . "'";
        }
        if (!empty($filter['order_status'])) {
            $where .= " and po.order_status ='" . $filter['order_status'] . "'";
        }
        if (!empty($filter['payment_status'])) {
            $where .= " and pop.payment_status ='" . $filter['payment_status'] . "'";
        }
        if (!empty($filter['from_ordered_at']) && !empty($filter['to_ordered_at'])) {
            $where .= " and po.created_at >='" . $filter['from_ordered_at'] . "' AND po.created_at <='" . $filter['to_ordered_at'] . "'";
        }
        $sql = "select po.*,c.first_name as first_name,c.last_name as last_name,c.email as email,pop.sub_total as sub_total,
		pop.vat as vat,pop.shipping_charge as shipping_charge,pop.grand_total as grand_total,pop.payment_status as payment_status,pop.payment_option as payment_option from product_order as po
		 left join users as c on po.customer_id=c.id
		 left join product_order_payment as pop on po.id=pop.order_id where " . $where;
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

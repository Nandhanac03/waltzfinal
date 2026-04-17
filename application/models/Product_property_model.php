<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_property_model extends CO_Core_Model
{

    protected $tableName = 'product_property';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array(), $limit = "")
    {
        $fetch_row = FALSE;
        $where = "active = '1'";
        if (!empty($filter['attribute_id'])) {
            $where .= " and attribute_id ='" . $filter['attribute_id'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and product_id ='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['variant_id'])) {
            $where .= " and variant_id ='" . $filter['variant_id'] . "'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function get_property($filter = array(), $fetch_row=true,$limit = "")
    {
        $where = "active = '1'";
        if (!empty($filter['attribute_id'])) {
            $where .= " and attribute_id ='" . $filter['attribute_id'] . "'";
        }
        if (!empty($filter['attribute_value_id'])) {
            $where .= " and attribute_value_id ='" . $filter['attribute_value_id'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and product_id ='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['variant_id'])) {
            $where .= " and variant_id ='" . $filter['variant_id'] . "'";
        }
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
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

    public function get($id, $active = TRUE)
    {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function check_property_exists($attribute_id, $attribute_value_id = '', $product_id = '', $active = TRUE)
    {
        $where = " attribute_id='$attribute_id'";
        if ($attribute_value_id) {
            $where .= " and attribute_value_id='$attribute_value_id'";
        }
        if ($product_id) {
            $where .= " and product_id='$product_id'";
        }
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function get_all_product_properties($filter = array())
    {
        $fetch_row = FALSE;
        $where = " where pv.active = '1'";
        if (!empty($filter['product_id'])) {
            $where .= " and pv.product_id ='" . $filter['product_id'] . "'";
        }
        $where .= " order by pv.created_at desc";
        $sql = "select pv.*,pa.title as attribute_title,pav.attribute_value as attribute_value
		from product_property as pv inner join product_attribute as pa on pv.attribute_id=pa.id
		 inner join product_attribute_value as pav on pv.attribute_value_id=pav.id " . $where;
        return $this->full_query($sql, $fetch_row);
    }

    public function get_by_variant($id, $active = TRUE)
    {
        $where = "variant_group='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, FALSE);
    }

    public function disable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function remove_variant($product_id, $attribute_id)
    {
        $query = "delete from product_property where product_id='$product_id'  and attribute_id='$attribute_id'";
        return $this->full_query($query);
    }

    public function get_attributes_value($product_id, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT attribute_value_id) as attributes_value  from product_property where product_id='$product_id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }
}

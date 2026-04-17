<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_rating_model extends CO_Core_Model
{

    protected $tableName = 'product_rating';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function save($data = array(), $id = NULL)
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

    public function get($filter = array(), $fetch_row = FALSE, $limit = "")
    {

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

    public function get_total_rating($filter=array())
    {
        $where = "active = '1' and approved='1'";
        if (!empty($filter['product_id'])) {
            $where .= " and product_id='" . $filter['product_id'] . "'";
        }
        return $this->select("sum(rating) as total_rating, count(*) as total_count,
         sum(case when rating=1 then 1 else 0 end) as total_rating_1,
         sum(case when rating=2 then 1 else 0 end) as total_rating_2,
         sum(case when rating=3 then 1 else 0 end) as total_rating_3,
         sum(case when rating=4 then 1 else 0 end) as total_rating_4,
         sum(case when rating=5 then 1 else 0 end) as total_rating_5
         ", $where, true);
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

}

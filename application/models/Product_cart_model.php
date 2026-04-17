<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_cart_model extends CO_Core_Model {

    protected $tableName = 'product_cart';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $where = " where pc.active = '1'";
        if (!empty($filter['created_at'])) {
            $where .= " and pc.created_at ='" . $filter['created_at'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and pc.product_id ='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $where .= " and pc.created_by ='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['units_in_stock'])) {
            $where .= " and p.units_in_stock >'0'";
        }
        if (!empty($filter['customer_type'])) {
            $where .= " and pc.customer_type ='" . $filter['customer_type'] . "'";
        }
        $where .= " order by pc.created_at desc";
        $sql = "select p.*,pc.id as cart_id,pc.quantity as cart_quantity,pc.created_by as cart_created_by,pc.created_at as cart_created_at
		from product as p inner join product_cart as pc on p.id=pc.product_id " . $where;
        return $this->full_query($sql, $fetch_row);
    }

    public function get_by_lang($filter = array(), $lang = '', $fetch_row = false, $limit = "") {       
        $where = " where pc.active = '1' and p.language=1";
        if (!empty($filter['created_at'])) {
            $where .= " and pc.created_at ='" . $filter['created_at'] . "'";
        }
        if (!empty($filter['product_id'])) {
            $where .= " and pc.product_id ='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $where .= " and pc.created_by ='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['units_in_stock'])) {
            $where .= " and p.units_in_stock >'0'";
        }
        if (!empty($filter['customer_type'])) {
            $where .= " and pc.customer_type ='" . $filter['customer_type'] . "'";
        }
        if (!empty($filter['customer_type'])) {
            $where .= " and pc.customer_type ='" . $filter['customer_type'] . "'";
        }
        $where .= " order by pc.created_at desc";
        $case_columns = ", CASE WHEN lp.language='$lang' AND lp.product_name!='' THEN lp.product_name ELSE p.product_name END AS product_name";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title!='' THEN lp.title ELSE p.title END AS title";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title_slug!='' THEN lp.title_slug ELSE p.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.subtitle!='' THEN lp.subtitle ELSE p.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.illustrator!='' THEN lp.illustrator ELSE p.illustrator END AS illustrator";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.author!='' THEN lp.author ELSE p.author END AS author";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.short_desc!='' THEN lp.short_desc ELSE p.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.description!='' THEN lp.description ELSE p.description END AS description";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.note!='' THEN lp.note ELSE p.note END AS note";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language ELSE p.language END AS language";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language_parent ELSE p.language_parent END AS language_parent";
        $sql = "select p.*,pc.id as cart_id,pc.quantity as cart_quantity,pc.created_by as cart_created_by,pc.created_at as cart_created_at
		$case_columns from product as p inner join product_cart as pc on p.id=pc.product_id left join product as lp on p.id=lp.language_parent " . $where;
        return $this->full_query($sql, $fetch_row);
    }

    public function get_by_product($filter = array(), $limit = "") {
        $fetch_row = TRUE;
        $where = " where pc.active = '1'";
        if (!empty($filter['product_id'])) {
            $where .= " and pc.product_id ='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $where .= " and pc.created_by ='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['units_in_stock'])) {
            $where .= " and p.units_in_stock >'0'";
        }
        if (!empty($filter['customer_type'])) {
            $where .= " and pc.customer_type ='" . $filter['customer_type'] . "'";
        }
        $where .= " order by pc.created_at desc";
        $sql = "select p.*,pc.id as cart_id,pc.quantity as cart_quantity,pc.created_by as cart_created_by,pc.created_at as cart_created_at
		from product as p inner join product_cart as pc on p.id=pc.product_id " . $where;
        return $this->full_query($sql, $fetch_row);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id, $customer_type = 'GU') {
        $where = "id='$id'";
        if ($customer_type) {
            $where .= " and customer_type='$customer_type'";
        }
        return $this->insert($data, $where);
    }

    public function get($id, $custom_type = 'GU', $active = TRUE) {
        $where = "id='$id'";
        if ($custom_type) {
            $where .= " and custom_type='$custom_type'";
        }
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function remove($id='', $user_id = '', $custom_type = 'GU',$created_at='') {
        $where='id>0';
        if ($id) {
            $where .= " and id='$id'";
        }
        if ($user_id) {
            $where .= " and created_by='$user_id'";
        }
        if ($custom_type) {
            $where .= " and customer_type='$custom_type'";
        }
        if($created_at>0){
            $where .= " and created_at<='$created_at'";
        }
        $sql = "delete from product_cart where " . $where;
        return $this->full_query($sql);
    }

}

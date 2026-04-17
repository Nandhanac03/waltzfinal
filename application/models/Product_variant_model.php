<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_variant_model extends CO_Core_Model
{

    protected $tableName = 'product_variant';

    public function __construct()
    {
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

    public function get_by_lang($filter = array(), $lang = '', $fetch_row = false, $limit = '')
    {
        $case_columns = ", CASE WHEN lp.language='$lang' AND lp.product_name!='' THEN lp.product_name ELSE p.product_name END AS product_name";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title!='' THEN lp.title ELSE p.title END AS title";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title_slug!='' THEN lp.title_slug ELSE p.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.subtitle!='' THEN lp.subtitle ELSE p.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.short_desc!='' THEN lp.short_desc ELSE p.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.description!='' THEN lp.description ELSE p.description END AS description";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.note!='' THEN lp.note ELSE p.note END AS note";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language ELSE p.language END AS language";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language_parent ELSE p.language_parent END AS language_parent";
        $columns= ",pv.product_code as product_code";
        $columns.= ",pv.sku as sku";
        $columns.= ",pv.quantity_per_unit as quantity_per_unit";
        $columns.= ",pv.unit_price as unit_price";
        $columns.= ",pv.manufacturer_retail_price as manufacturer_retail_price";
        $columns.= ",pv.selling_price as selling_price";
        $columns.= ",pv.discount as discount";
        $columns.= ",pv.units_in_stock as units_in_stock";
        $query = "select p.* $case_columns,$columns from product as p left join product as lp on p.id=lp.language_parent ";
        $query .= " inner join product_variant as pv on pv.product_id=p.id";
        $query .= " left join brand as b on b.id=p.brand_id";
        $query .= " where p.language=1";
        if (!empty($filter['product_id'])) {
            $query .= " AND p.id='" . $filter['product_id'] . "'";
        }
        if (!empty($filter['products'])) {
            $query .= " AND p.id in(" . $filter['products'] . ")";
        }
        if (!empty($filter['category_id'])) {
            $query .= " AND p.category_id='" . $filter['category_id'] . "'";
        }
        if (!empty($filter['product_title'])) {
            $query .= " AND (p.title like '%" . $filter['product_title'] . "%' or p.product_name like '%" . $filter['product_title'] . "%')";
        }
        if (!empty($filter['from_created_at'])) {
            $query .= " AND p.created_at>='" . $filter['from_created_at'] . "'";
        }
        if (!empty($filter['to_created_at'])) {
            $query .= " AND p.created_at<='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $query .= " AND p.created_by='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['language_id'])) {
            $query .= " AND p.language='" . $filter['language_id'] . "'";
        }
        if (!empty($filter['search_product'])) {
            $query .= " AND (p.title like '%" . $filter['search_product'] . "%' or p.product_name like '%" . $filter['search_product'] . "%' 
			or p.product_code like '%" . $filter['search_product'] . "%' or p.isbn like '%" . $filter['search_product'] . "%' or p.description like '%" . $filter['search_product'] . "%')";
        }
        if (!empty($filter['search_attribute_value'])) {
            $query .= " AND p.id in(select product_id from product_property 
			where attribute_value_id in(" . $filter['search_attribute_value'] . ") and active=1)";
        }
        if (!empty($filter['active']) && $filter['active'] != 'all') {
            $query .= " AND p.active='" . $filter['active'] . "'";
        } else if (!empty($filter['active']) && $filter['active'] == 'all') {
            $query .= " AND (p.active='0' OR p.active='1')";
        } else {
            $query .= " AND p.active='1'";
        }
        if (!empty($filter['brand_disabled'])) {
            $query .= " AND b.active!='1'";
        }
        if ($limit) {
            $query .= " limit " . $filter['limit'];
        }
        return $this->full_query($query, $fetch_row);
    }

    public function get($id, $lang = '', $active = TRUE)
    {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function get_all($id, $lang = '', $active = TRUE,$fetch_row=FALSE)
    {
        $where = "product_id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }


    public function get_languages($product_id, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT language) as languages from product where id='$product_id' or language_parent='$product_id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

    public function get_by_parent($id, $lang = '', $active = TRUE)
    {
        $fetch_row = TRUE;
        $where = " language_parent='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function disable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function enable($id = '')
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '1';
        return $this->insert($data, $where);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CO_Core_Model
{

    protected $tableName = 'product';

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

    public function get_all_product($filter = array())
    {
        $query = "select p.* from product as p ";
        $query .= " left join brand as b on b.id=p.brand_id";
        $query .= " where p.id>0 ";
        if (!empty($filter['product_id'])) {
            $query .= " AND p.id in(" . $filter['product_id'] . ")";
        }
        if (!empty($filter['category_id'])) {
            $query .= " AND p.category_id='" . $filter['category_id'] . "'";
        }
        if (!empty($filter['brand_id'])) {
            $query .= " AND p.brand_id='" . $filter['brand_id'] . "'";
        }
        if (!empty($filter['product_title'])) {
            $query .= " AND (p.title like '%" . $filter['product_title'] . "%' or p.product_name like '%" . $filter['product_title'] . "%' or p.product_code like '%" . $filter['product_title'] . "%')";
        }
        if (!empty($filter['product_group'])) {
            $query .= " AND FIND_IN_SET(" . $filter['product_group'] . ",p.product_group)>0";
        }
        if (!empty($filter['product_category'])) {
            $query .= " AND p.category='" . $filter['product_category'] . "'";
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
        if (isset($filter['active'])) {
            if ($filter['active'] != 'all') {
                $query .= " AND p.active='" . $filter['active'] . "'";
            }
        }
        if (!empty($filter['brand_disabled'])) {
            $query .= " AND b.active!='1'";
        }
        $query .= " order by orderby asc";
        if (isset($filter['limit'])) {
            $query .= " limit " . $filter['limit'];
        }
        return $this->full_query($query);
    }
    public function get_all_home_product($filter = array())
    {
        $query = "select p.* from product as p ";
        $query .= " left join brand as b on b.id=p.brand_id";
        $query .= " where p.id>0 ";
        if (!empty($filter['product_id'])) {
            $query .= " AND p.id in(" . $filter['product_id'] . ")";
        }
        if (!empty($filter['category_id'])) {
            $query .= " AND p.category_id='" . $filter['category_id'] . "'";
        }
        if (!empty($filter['brand_id'])) {
            $query .= " AND p.brand_id='" . $filter['brand_id'] . "'";
        }
        if (!empty($filter['product_title'])) {
            $query .= " AND (p.title like '%" . $filter['product_title'] . "%' or p.product_name like '%" . $filter['product_title'] . "%' or p.product_code like '%" . $filter['product_title'] . "%')";
        }
        if (!empty($filter['product_group'])) {
            $query .= " AND FIND_IN_SET(" . $filter['product_group'] . ",p.product_group)>0";
        }
        if (!empty($filter['product_category'])) {
            $query .= " AND p.category='" . $filter['product_category'] . "'";
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
        if (isset($filter['active'])) {
            if ($filter['active'] != 'all') {
                $query .= " AND p.active='" . $filter['active'] . "'";
            }
        } else {
            $query .= " AND p.active='1'";
        }
        if (!empty($filter['brand_disabled'])) {
            $query .= " AND b.active!='1'";
        }
        $query .= " AND p.home_display='1'";
        $query .= " order by created_at desc";
        if (isset($filter['limit'])) {
            $query .= " limit " . $filter['limit'];
        }
        return $this->full_query($query);
    }
    public function get_by_lang($filter = array(), $lang = '', $fetch_row = false, $limit = '')
    {
        $case_columns = ", CASE WHEN lp.language='$lang' AND lp.product_name!='' THEN lp.product_name ELSE p.product_name END AS product_name";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title!='' THEN lp.title ELSE p.title END AS title";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.title_slug!='' THEN lp.title_slug ELSE p.title_slug END AS title_slug";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.subtitle!='' THEN lp.subtitle ELSE p.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.illustrator!='' THEN lp.illustrator ELSE p.illustrator END AS illustrator";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.author!='' THEN lp.author ELSE p.author END AS author";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.short_desc!='' THEN lp.short_desc ELSE p.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.description!='' THEN lp.description ELSE p.description END AS description";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.additonal_info!='' THEN lp.additonal_info ELSE p.additonal_info END AS additonal_info";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.note!='' THEN lp.note ELSE p.note END AS note";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.seo_title!='' THEN lp.seo_title ELSE p.seo_title END AS seo_title";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.seo_meta_keywords!='' THEN lp.seo_meta_keywords ELSE p.seo_meta_keywords END AS seo_meta_keywords";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.seo_meta_description!='' THEN lp.seo_meta_description ELSE p.seo_meta_description END AS seo_meta_description";
        $case_columns .= ", CASE WHEN lp.language='$lang' AND lp.seo_canonical_url!='' THEN lp.seo_canonical_url ELSE p.seo_canonical_url END AS seo_canonical_url";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language ELSE p.language END AS language";
        $case_columns .= ", CASE WHEN lp.language='$lang' THEN lp.language_parent ELSE p.language_parent END AS language_parent";
        $query = "select p.* $case_columns from product as p left join product as lp on p.id=lp.language_parent ";
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
        if (!empty($filter['brand_id'])) {
            $query .= " AND p.brand_id='" . $filter['brand_id'] . "'";
        }
        if (!empty($filter['product_group'])) {
            $query .= " AND FIND_IN_SET(" . $filter['product_group'] . ",p.product_group)>0";
        }
        if (!empty($filter['product_title'])) {
            $query .= " AND (p.title like '%" . $filter['product_title'] . "%' or p.product_name like '%" . $filter['product_title'] . "%')";
        }
        if (!empty($filter['product_category'])) {
            $query .= " AND p.category='" . $filter['product_category'] . "'";
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
        if (!empty($filter['author'])) {
            $query .= " AND p.author='" . $filter['author'] . "'";
        }
        if (!empty($filter['illustrator'])) {
            $query .= " AND p.author='" . $filter['illustrator'] . "'";
        }
        if (!empty($filter['search_brand'])) {
            $query .= " AND p.brand_id in(" . $filter['search_brand'] . ")";
        }
        if (!empty($filter['search_product'])) {
            $query .= " AND (p.title like '%" . $filter['search_product'] . "%' or p.product_name like '%" . $filter['search_product'] . "%' 
			or p.product_code like '%" . $filter['search_product'] . "%' or p.isbn like '%" . $filter['search_product'] . "%' or p.description like '%" . $filter['search_product'] . "%')";
        }
        if (!empty($filter['search_group'])) {
            $search_groups = explode(',', $filter['search_group']);
            $query .= " AND (";
            $i = 1;
            foreach ($search_groups as $search_group) {
                if ($i != 1) {
                    $query .= " OR ";
                }
                $query .= "  FIND_IN_SET(" . $search_group . ",p.product_group)>0";
                $i++;
            }
            $query .= ")";
        }
        if (!empty($filter['search_attribute_value'])) {
            $query .= " AND p.id in(select product_id from product_property 
			where attribute_value_id in(" . $filter['search_attribute_value'] . ") and active=1)";
        }
        if (!empty($filter['search_category'])) {
            $query .= " AND p.category_id in(" . $filter['search_category'] . ")";
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

    public function get_product_by_category($category_id, $lang = 1, $active = TRUE)
    {
        $where = "category_id='$category_id'";
        $where .= " AND language='$lang'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, FALSE);
    }

    public function get_products($id, $lang = '', $active = TRUE)
    {
        $where = "id in(" . $id . ")";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, FALSE);
    }

    public function get_product_by_group($group_id, $lang = 1, $active = TRUE)
    {
        $where = " FIND_IN_SET(" . $group_id . ",product_group)>0";
        $where .= " AND language='$lang'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, FALSE);
    }

    public function get_category_by_group($group_id, $lang = 1, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT category_id) as categories from product where FIND_IN_SET(" . $group_id . ",product_group)>0";
        $query .= " AND language='$lang'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
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

    public function get_related_products($filter = array())
    {
        $query = "select group_concat(id) as ids from product where id>0";
        if (!empty($filter['search_category'])) {
            $query .= " OR category_id in(" . $filter['search_category'] . ")";
        }
        if (!empty($filter['author'])) {
            $query .= " OR author='" . $filter['author'] . "'";
        }
        if (!empty($filter['illustrator'])) {
            $query .= " OR illustrator='" . $filter['illustrator'] . "'";
        }
        if (!empty($filter['product_group'])) {
            $query .= " OR FIND_IN_SET(" . $filter['product_group'] . ",product_group)>0";
        }
        if (!empty($filter['product_id'])) {
            $query .= " AND id  not in(" . $filter['product_id'] . ")";
        }
        if (!empty($filter['order_by_rand'])) {
            $query .= " ORDER BY RAND()";
        }
        return $this->full_query($query, true);
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

    public function check_category_exists($name, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and title='$name'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    // public function get_by_slug($slug, $lang = '', $active = TRUE) {
    //     $where = "title_slug='$slug'";
    //     if ($active == TRUE) {
    //         $where .= " AND active='1'";
    //     }
    //     if ($lang != '') {
    //         $where .= " AND language='$lang'";
    //     }
    //     $join="JOIN product_categories ON product.category_id=product_category.id";
    //     return $this->select("*", $where, TRUE, $join);
    // }

    public function get_by_slug($slug, $lang = '', $active = TRUE)
    {
        $sql = "SELECT product.*FROM `product` where product.title_slug='$slug' AND product.active='1'";
        return $this->full_query($sql);
    }

    public function delete_product($id)
    {
        $sql = "DELETE from product where id=$id";
        return $this->full_query($sql);
    }
    public function get_product_without_status($id)
    {
        $sql = "select * from product where id=$id";
        return $this->full_query($sql);
    }
}

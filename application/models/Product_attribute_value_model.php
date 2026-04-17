<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_attribute_value_model extends CO_Core_Model
{

    protected $tableName = 'product_attribute_value';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function get_all($filter = array(), $limit = "")
    {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        if (!empty($filter['attribute_id'])) {
            $where .= " and attribute_id ='" . $filter['attribute_id'] . "'";
        }
        if (!empty($filter['parent_id'])) {
            $where .= " and parent_id ='" . $filter['parent_id'] . "'";
        }
        if (!empty($filter['from_created_at']) && !empty($filter['to_created_at'])) {
            $where .= " and created_at >='" . $filter['from_created_at'] . "' AND created_at <='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['parent_only'])) {
            $where .= " and (parent_id='0' OR parent_id='' OR parent_id IS NULL)";
        }
        if (!empty($filter['lang'])) {
            $where .= " and language='" . $filter['lang'] . "'";
        }
        $order_by = " value_order asc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

    public function add($data)
    {
        return $this->insert($data);
    }

    public function update($data, $id, $lang = '')
    {
        $where = "id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
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

    public function get_by_lang_parent($id, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and language_parent='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }

    public function check_value_exists($value, $attribute_id, $lang = 1, $active = TRUE)
    {
        $where = "attribute_value='$value'";
        $where .= " and attribute_id='$attribute_id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang) {
            $where .= " and language='$lang'";
        }
        $result = $this->select("*", $where, TRUE);
        return $result ? TRUE : FALSE;
    }

    public function get_by_attribute($id, $lang = 1, $active = TRUE)
    {
        $where = "attribute_id='$id'";
        if ($lang) {
            $where .= " and language='$lang'";
        }
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, FALSE);
    }

    public function get_by_lang($ids = '', $lang = 1, $fetch_row = false)
    {
        $where = "v.active = '1' and v.language = '1'";
        if ($ids) {
            $where .= " and v.attribute_id in(" . $ids . ")";
        }
        $order_by = " order by v.value_order";
        $case_columns = ", CASE WHEN lv.attribute_value='$lang' AND lv.attribute_value!='' THEN lv.attribute_value ELSE v.attribute_value END AS attribute_value";
        $case_columns .= ", CASE WHEN lv.language='$lang' THEN lv.language ELSE v.language END AS language";
        $case_columns .= ", CASE WHEN lv.language='$lang' THEN lv.language_parent ELSE v.language_parent END AS language_parent";
        $query = "select v.* $case_columns from $this->tableName as v
		left join $this->tableName  as lv on v.id=lv.language_parent  where " . $where . $order_by;

        return $this->full_query($query, $fetch_row);
    }

    public function get_attribute_value($id = '', $value_id = '', $lang = 1, $fetch_row = false)
    {
        $where = "v.active = '1' and v.language = '1'";
        if ($id) {
            $where .= " and v.attribute_id ='$id'";
        }
        if ($value_id) {
            $where .= " and v.id ='$value_id'";
        }
        $order_by = " order by v.value_order";
        $case_columns = ", CASE WHEN lv.attribute_value='$lang' AND lv.attribute_value!='' THEN lv.attribute_value ELSE v.attribute_value END AS attribute_value";
        $case_columns .= ", CASE WHEN lv.language='$lang' THEN lv.language ELSE v.language END AS language";
        $case_columns .= ", CASE WHEN lv.language='$lang' THEN lv.language_parent ELSE v.language_parent END AS language_parent";
        $query = "select v.* $case_columns from $this->tableName as v
		left join $this->tableName  as lv on v.id=lv.language_parent  where " . $where . $order_by;

        return $this->full_query($query, $fetch_row);
    }

    public function disable($id)
    {
        $where = "";
        if ($id) {
            $where .= " id = '" . $id . "'";
            $where .= " or  language_parent = '" . $id . "'";
        }
        $data['active'] = '0';
        return $this->insert($data, $where);
    }

    public function get_languages($id, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT language) as languages from product_attribute_value where language_parent='$id' OR id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

    public function check_attribute_value_exists($value, $attribute_id, $lang = '')
    {
        $fetch_row = TRUE;
        $where = "active = '1' and attribute_value='$value' and attribute_id='$attribute_id'";
        if ($lang) {
            $where .= " and language = '$lang'";
        }
        return $this->select("*", $where, $fetch_row);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_file_description_model extends CO_Core_Model {

    protected $tableName = 'product_file_description';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $file_id, $lang = 1) {
        $where = "file_id='$file_id'";
        $where .= " AND language='$lang'";
        return $this->insert($data, $where);
    }

    public function get_file_description($file_id, $lang = 1, $active = TRUE) {
        $where = "file_id='$file_id'";
        $where .= " AND language='$lang'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function delete_file_description($file_id, $lang = 1) {
        $query = "delete from product_file_description where file_id='$file_id' AND language='$lang'";
        return $this->full_query($query);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from product_file_description where file_id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

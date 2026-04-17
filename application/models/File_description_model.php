<?php

defined('BASEPATH') or exit('No direct script access allowed');

class File_description_model extends CO_Core_Model {

    protected $tableName = 'files_description';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get_file_description($id = '', $file_id = '', $lang = 1, $active = TRUE) {
        $where = "  language='$lang'";
        if ($file_id != '') {
            $where .= " AND file_id='$file_id'";
        }
        if ($id != '') {
            $where .= " AND id='$id'";
        }
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function delete_file_description($file_id, $lang = '') {
        $query = "delete from files_description where file_id='$file_id' ";
        if ($lang != '') {
            $query .= " AND language='$lang'";
        }
        return $this->full_query($query);
    }

    public function get_languages($id, $active = TRUE) {
        $query = "select group_concat(DISTINCT language) as languages from files_description where file_id='$id'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }

}

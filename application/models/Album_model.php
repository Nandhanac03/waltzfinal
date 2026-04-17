<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Album_model extends CO_Core_Model {

    protected $tableName = 'album';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data = array(), $id = "") {
        $where = '';
        if ($id) {
            $where .= "id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

    public function get($id) {
        $fetch_row = TRUE;
        $where = "active = '1'";
        if ($id) {
            $where .= " and id = '" . $id . "'";
        }
        return $this->select('*', $where, $fetch_row);
    }

    public function get_all() {
        $fetch_row = FALSE;
        $where = "active = '1'";
        return $this->select('*', $where, $fetch_row);
    }

    public function delete_album($id) {
        if ($id > 0) {
            $query = "delete from album where id='$id'";
            return $this->full_query($query);
        }
    }

    public function set_album_cover($id, $cover) {
        $data = array('album_cover' => $cover,);
        $where = '';
        if ($id) {
            $where .= "id = '" . $id . "'";
        }
        return $this->insert($data, $where);
    }

}

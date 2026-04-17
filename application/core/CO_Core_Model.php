<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CO_Core_Model extends CI_Model
{
    private $tableName;
    public $affected_rows;
    public $inserted_id;
    public $num_rows;
    public $query;
    
    function __construct($table_name)
    {

        parent::__construct();
        $this->tableName = $table_name;
        $this->inserted_id = 0;
        $this->affected_rows = 0;
        $this->num_rows = 0;
        $this->query = NULL;
        $this->load->helper('security');
    }

    // calling select query based on parameters
    public function select($column = '*', $where = FALSE, $fetch_row = FALSE, $order_by = FALSE, $limit = FALSE)
    {

        $this->num_rows = 0;
        $this->db->select($column);
        if ($where) {
            $this->security->xss_clean($where);
            $this->db->where($where);
        }
        if ($fetch_row == TRUE) {
            $method = "row";
        } else {
            $method = "result";
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $result = $this->db->get($this->tableName)->$method();
        $this->num_rows = $this->db->count_all_results($this->tableName);
        $this->query = $this->db->last_query();
        if ($this->num_rows > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    // calling insert or update query based on parameter
    public function insert($data, $where = FALSE)
    {

        $this->inserted_id = 0;
        $this->affected_rows = 0;
        //for insert
        if ($where == FALSE) {
            $this->security->xss_clean($data);
            $this->db->set($data);
            $this->db->insert($this->tableName);
            $this->inserted_id = $this->db->insert_id();
            $this->query = $this->db->last_query();

            return $this->db->insert_id();
        } //for update
        else {
            $this->security->xss_clean($data);
            $this->security->xss_clean($where);
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update($this->tableName);
            $this->affected_rows = $this->db->affected_rows();
            $this->query = $this->db->last_query();

            return TRUE;
        }
    }

    // calling delete query based on parameter
    public function delete($where = FALSE, $limit = TRUE)
    {

        $this->affected_rows = 0;
        if ($where == FALSE) {
            return FALSE;
        }
        $this->db->where($where);
        $this->security->xss_clean($where);
        if ($limit == TRUE)
            $this->db->limit(1);
        $this->db->delete($this->tableName);
        $this->affected_rows = $this->db->affected_rows();
        $this->query = $this->db->last_query();

        return TRUE;
    }

    // checking table exits or note
    public function tableExists()
    {

        $this->query = $this->db->last_query();

        return $this->db->table_exists($this->tableName);
    }

    // get count of all the rows in table
    public function countTotalRows($where = NULL, $column = '*')
    {

        if ($where != NULL) {
            $this->security->xss_clean($where);
            $this->db->where($where);
        }
        $this->db->select($column);
        $this->query = $this->db->last_query();

        return $this->db->count_all_results($this->tableName);
    }

    //execute long query
    public function full_query($query, $fetch_row = FALSE)
    {

        $query = trim($query);
        if ($query) {
            $this->security->xss_clean($query);
            $words = str_word_count($query, 1);
            $first_word = strtoupper($words[0]);
            if ($first_word == 'SELECT') {
                if ($fetch_row == TRUE) {
                    $method = "row";
                } else {
                    $method = "result";
                }
                $this->num_rows = $this->db->query($query)->num_rows();
                $result = $this->db->query($query)->$method();
                $this->query = $this->db->last_query();
                if ($this->num_rows > 0) {
                    return $result;
                } else {
                    return FALSE;
                }
            } else if ($first_word == 'INSERT') {
                $this->db->query($query);
                $this->inserted_id = $this->db->insert_id();
                $this->query = $this->db->last_query();

                return $this->inserted_id;
            } else if ($first_word == 'UPDATE') {
                $this->db->query($query);
                $this->affected_rows = $this->db->affected_rows();
                $this->query = $this->db->last_query();

                return TRUE;
            } else if ($first_word == 'DELETE') {
                $this->db->query($query);
                $this->affected_rows = $this->db->affected_rows();
                $this->query = $this->db->last_query();

                return TRUE;
            }

            return FALSE;
        }
    }

    public function last_row_id($primay_key_column)
    {

        $this->db->order_by($primay_key_column, "desc");
        $this->db->limit(1);
        $this->db->get($primay_key_column);
        $this->num_rows = $this->db->get($primay_key_column)->num_rows();
        $result = $this->db->row();
        $this->query = $this->db->last_query();
        if ($this->num_rows > 0) {
            return $result->$primay_key_column;
        } else {
            return FALSE;
        }
    }

}

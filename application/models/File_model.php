<?php

defined('BASEPATH') or exit('No direct script access allowed');

class file_model extends CO_Core_Model
{

    protected $tableName = 'files';

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

    public function get_all_files($where = '', $limit = '')
    {
        $order_by = 'created_at desc';
        return $this->select("*", $where, 'FALSE', $order_by, $limit);
    }

    public function get_all($parent_id = '', $lang = '', $file_type = '', $file_for = '')
    {
        $query = "select f.*,fd.title as title,fd.subtitle as subtitle,fd.button_name as button_name,fd.link as link,
       fd.short_desc as short_desc, fd.description as description from files as f left join files_description as fd on f.id=fd.file_id 
       where f.active=1 and fd.active=1";
        if ($parent_id != '') {
            $query .= " and f.parent_id='$parent_id'";
        }
        if ($lang != '') {
            $query .= " and fd.language='$lang'";
        }
        if ($file_type != '') {
            $query .= " and f.file_type='$file_type'";
        }
        if ($file_for != '') {
            $query .= " and f.file_for='$file_for'";
        }
        $query .= " order by f.created_at desc";
        return $this->full_query($query);
    }


   
  
  
  
  
   public function get_all_by_order($parent_id = '', $lang = '', $file_type = '', $file_for = '')
    {
        $query = "select f.*,fd.title as title,fd.subtitle as subtitle,fd.button_name as button_name,fd.link as link,
       fd.short_desc as short_desc, fd.description as description from files as f left join files_description as fd on f.id=fd.file_id 
       where f.active=1 and fd.active=1";
        if ($parent_id != '') {
            $query .= " and f.parent_id='$parent_id'";
        }
        if ($lang != '') {
            $query .= " and fd.language='$lang'";
        }
        if ($file_type != '') {
            $query .= " and f.file_type='$file_type'";
        }
        if ($file_for != '') {
            $query .= " and f.file_for='$file_for'";
        }
        $query .= " order by f.order asc";
        return $this->full_query($query);
    }
  
  
  
  
  

    public function get_all_by_giri($parent_id='', $lang='', $file_type='', $file_for=''){
        $query="SELECT f.*, fd.title as title, fd.subtitle as subtitle, fd.button_name as button_name, fd.link as link,
        fd.short_desc as short_desc, fd.description as description  FROM files as f JOIN files_description as fd on f.id=fd.file_id WHERE 1";
        if($parent_id!=''){
            $query.=" AND f.parent_id='".$parent_id."'";
        }
        if ($lang != '') {
            $query .= " AND fd.language='$lang'";
        }
        if ($file_type != '') {
            $query .= " AND f.file_type='$file_type'";
        }
        if ($file_for != '') {
            $query .= " AND f.file_for='$file_for'";
        }
        return $this->full_query($query);
    }

    public function get_by_lang($filter = array(), $lang = '', $fetch_row = false)
    {
        $case_columns = ", CASE WHEN lfd.language='$lang' AND  lfd.title!='' THEN lfd.title ELSE fd.title END AS title";
        $case_columns .= ", CASE WHEN lfd.language='$lang' AND lfd.subtitle!='' THEN lfd.subtitle ELSE fd.subtitle END AS subtitle";
        $case_columns .= ", CASE WHEN lfd.language='$lang' AND lfd.short_desc!='' THEN lfd.short_desc ELSE fd.short_desc END AS short_desc";
        $case_columns .= ", CASE WHEN lfd.language='$lang' AND lfd.description!='' THEN lfd.description ELSE fd.description END AS description";
        $case_columns .= ", CASE WHEN lfd.language='$lang' THEN lfd.language ELSE fd.language END AS language";
        $case_columns .= ", CASE WHEN lf.language='$lang' AND lf.file!='' THEN lf.file ELSE f.file END AS file";
        $query = "select f.*,fd.link as link $case_columns from files as f 
		left join files as lf on f.id=lf.language_parent and f.language='1'
		left join files_description as fd on f.id=fd.file_id and fd.language='1' and fd.active=1
	    left join files_description as lfd on f.id=lfd.file_id where f.active=1  ";
        if ( ! empty($filter['parent_id'])) {
            $query .= " and f.parent_id='".$filter['parent_id']."'";
        }
        if ( ! empty($filter['file_type'])) {
            $query .= " and f.file_type='".$filter['file_type']."'";
        }
        if ( ! empty($filter['file_for'])) {
            $query .= " and f.file_for='".$filter['file_for']."'";
        }
        if ( ! empty($filter['file_lang'])) {
            $query .= " and f.language='".$filter['file_lang']."'";
        }
        if ( ! empty($filter['file_description_lang'])) {
            $query .= " and fd.language='".$filter['file_description_lang']."'";
        }
        if(!empty($filter['file_order_asc'])) {
            $query .= " order by f.created_at asc";
        } else {
            $query .= " order by f.created_at desc";
        }
        return $this->full_query($query, $fetch_row);
    }

    public function get_file($id = '', $parent_id = '', $file_type = '', $file_for = '', $active = true, $lang = '', $language_parent = '')
    {
        $where = "id>0";
        if ($id != '') {
            $where .= " and id='$id'";
        }
        if ($parent_id != '') {
            $where .= " and parent_id='$parent_id'";
        }
        if ($active == true) {
            $where .= " and active='1'";
        }
        if ($file_type != '') {
            $where .= " and file_type='$file_type'";
        }
        if ($file_for != '') {
            $where .= " and file_for='$file_for'";
        }
        if ($lang != '') {
            $where .= " and language='$lang'";
        }
        if ($language_parent != '') {
            $where .= " and language_parent='$language_parent'";
        }
        return $this->select("*", $where, true);
    }

    public function delete_file($id, $parent_id = '', $file_type = '', $file_for = '')
    {
        if ($id > 0) {
            $query = "delete from files where id='$id'";
            if ($parent_id != '') {
                $query .= " and parent_id='$parent_id'";
            }
            if ($file_type != '') {
                $query .= " and file_type='$file_type'";
            }
            if ($file_for != '') {
                $query .= " and file_for='$file_for'";
            }
            if ($this->full_query($query)) {
                $query = "delete from files where language_parent='$id'";
                $this->full_query($query);
                return true;
            } else {
                return false;
            }
        }
    }

}

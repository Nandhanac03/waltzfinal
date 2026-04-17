<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CO_Core_Model
{

    protected $tableName = 'news';

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

    public function get_all_news($filter = array())
    {
        // echo"<pre>";print_r($filter);exit;
        $query = "select n.*, nr.type as newsroom_type,l.name as language_name, l.code as language_code, l.direction as language_direction, l.flag as language_flag
		 from news as n left join newsroom as nr on nr.id=n.newsroom
		 left join language as l on n.language=l.id where n.id>0";
        if (!empty($filter['news_id'])) {
            $query .= " AND n.id='" . $filter['news_id'] . "'";
        }
        if (!empty($filter['news_room_id'])) {
            $query .= " AND nr.id='" . $filter['news_room_id'] . "'";
        }
        if (!empty($filter['news_title'])) {
            $query .= " AND (n.title like '%" . $filter['news_title'] . "%' or n.news_code like '%" . $filter['news_title'] . "%')";
        }
        if (!empty($filter['news_room_type'])) {
            $query .= " AND nr.type='" . $filter['news_room_type'] . "'";
        }
        if (!empty($filter['news_status'])) {
            $query .= " AND n.status='" . $filter['news_status'] . "'";
        }
        if (!empty($filter['from_published_at'])) {
            $query .= " AND n.published_at<='" . $filter['from_published_at'] . "'";
        }
        if (!empty($filter['to_published_at'])) {
            $query .= " AND n.published_at>='" . $filter['to_published_at'] . "'";
        }
        if (!empty($filter['from_created_at'])) {
            $query .= " AND n.created_at>='" . $filter['from_created_at'] . "'";
        }
        if (!empty($filter['to_created_at'])) {
            $query .= " AND n.created_at<='" . $filter['to_created_at'] . "'";
        }
        if (!empty($filter['created_by'])) {
            $query .= " AND n.created_by='" . $filter['created_by'] . "'";
        }
        if (!empty($filter['language_id'])) {
            $query .= " AND n.language='" . $filter['language_id'] . "'";
        }
        if (!empty($filter['active'])) {
            $query .= " AND n.active='" . $filter['active'] . "'";
        }
        $query .= " order by n.created_at desc";
        if (isset($filter['limit'])) {
            $query .= " limit " . $filter['limit'];
        }
        return $this->full_query($query);
    }

    public function get_all_active_news($filter = array())
    {
        $query = "select n.* from news as n  where n.id>0 ";
        if ($filter['status']) {
            $query .= " and status = '" . $filter['status'] . "'";
        }
        if (!empty($filter['language_id'])) {
            $query .= " AND n.language='" . $filter['language_id'] . "'";
        }
        $query .= " order by n.created_at desc";
        return $this->full_query($query);
    }

    public function get_all_news_by_lang($filter = array())
    {
        $lang = (!empty($filter['language_id'])) ? $filter['language_id'] : 1;
        $query = "SELECT
            n.*,
            CASE
                WHEN nn.language = $lang
                AND nn.title != '' THEN nn.title
                ELSE n.title
            END AS title,
            CASE
                WHEN nn.language = $lang THEN nn.title_slug
                ELSE n.title_slug
            END AS title_slug,
            CASE
                WHEN nn.language = $lang THEN nn.subtitle
                ELSE n.subtitle
            END AS subtitle,
            CASE
                WHEN nn.language = $lang THEN nn.location
                ELSE n.location
            END AS location
        FROM
            `news` n
            LEFT JOIN news AS nn ON (n.newsroom = nn.newsroom and nn.language = $lang)
        WHERE
            n.active = '1'
            AND n.language = '1'";

        if ($filter['status']) {
            $query .= " AND n.status = '" . $filter['status'] . "'";
        }

        $query .= " order by n.created_at desc";
        return $this->full_query($query);
    }

    public function get_news($id, $lang = '1', $active = TRUE)
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

    public function get_news_by_newsroom($newsroom, $lang = 1, $active = TRUE)
    {
        $where = "newsroom='$newsroom'";
        $where .= " AND language='$lang'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }
    public function get_news_by_newsroom_for_panel($newsroom, $lang = 1, $active = TRUE)
    {
        $where = "newsroom='$newsroom'";
        $where .= " AND language='$lang'";
        return $this->select("*", $where, TRUE);
    }

    public function get_news_languages($newsroom, $active = TRUE)
    {
        $query = "select group_concat(DISTINCT language) as languages from news where newsroom='$newsroom'";
        if ($active == TRUE) {
            $query .= " AND active='1'";
        }
        return $this->full_query($query, TRUE);
    }
    public function get_news_by_slug($slug, $lang = '1', $active = TRUE)
    {
        $where = "title_slug='$slug'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        if ($lang != '') {
            $where .= " AND language='$lang'";
        }
        return $this->select("*", $where, TRUE);
    }
    public function get_news_without_status($id){
        $sql="SELECT * from news where id=$id";
        return $this->full_query($sql);
    }
    public function delete_news($id){
        $sql="DELETE from news where id=$id";
        return $this->full_query($sql);
    }
}

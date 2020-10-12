<?php

function get_fields($table)
{
    $ci = &get_instance();
    $fields = $ci->db->list_fields($table);
    foreach ($fields as $r) {
        $data[$r] = '';
    }
    return $data;
}

function get_by_id($key, $val, $tbl)
{
    $CI = &get_instance();
    $CI->db->where($key, $val);
    $query = $CI->db->get($tbl);
    return $query->row_array();
}

function getTable($table, $where = array())
{
    $ci = &get_instance();
    if ($where) {
        $ci->db->where($where);
    }
    $get = $ci->db->get($table)->result();
    return $get;
}

function getRowArray($table, $where = array())
{
    $ci = &get_instance();
    if ($where) {
        $ci->db->where($where);
    }
    $get = $ci->db->get($table)->row_array();
    return $get;
}

function getResultArray($table, $where = array())
{
    $ci = &get_instance();
    if ($where) {
        $ci->db->where($where);
    }
    $get = $ci->db->get($table)->result_array();
    return $get;
}

function getCount($table, $where = array())
{
    $ci = &get_instance();
    if ($where) {
        $ci->db->where($where);
    }
    $get = $ci->db->get($table)->num_rows();
    return $get;
}

function isDuplicate($table, $key, $value)
{
    $ci = &get_instance();
    $ci->db->where($key, $value);
    $checkUnique = $ci->db->get($table);
    if ($checkUnique->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

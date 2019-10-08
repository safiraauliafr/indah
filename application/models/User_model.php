<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getUsers($id)
    {
        $query = "SELECT * FROM tbl_users WHERE id = " . $id;
        // print_r($query);
        // die;
        return $this->db->query($query)->result_array();
    }

    public function get_all()
    {
        $query = $this->db->select("*")
            ->from('tbl_users')
            ->order_by('id', 'ASC')
            ->get();
        return $query->result();
    }

    public function get_user_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tbl_users')->result_array();
    }

    public function get($id)
    {
        $hasil = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('tbl_users');
        return $hasil->row();
    }

    public function simpan($data)
    {

        $query = $this->db->insert("tbl_users", $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($id)
    {

        $query = $this->db->where('id', $id)
            ->get("tbl_users");

        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $query = $this->db->update("pengguna", $data, $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->delete('tbl_users');
    }

    public function hapus($id)
    {

        $query = $this->db->delete("tbl_users", $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
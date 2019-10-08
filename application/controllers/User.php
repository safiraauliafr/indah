<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('company_profile_model');
        $this->load->model('akun_model');
        $this->load->model('user_model');
    }


    public function index()
    {
        $provinsi = $this->db->get('provinces');
        $data = array(
            'user' => $this->akun_model->get_all_user(),
            'userlogin' =>  $this->akun_model->get_user_by_id($this->session->userdata('id')),
            'provinces' =>   $this->akun_model->get_all_province(),
            'company' =>  $this->company_profile_model->ambil_company_id('1'),

        );

        $this->load->view('backend/user/index', $data);
    }

    public function tambah_user()
    {
        $this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|max_length[32]');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[64]');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|max_length[64]');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->user_model->get_user_id($this->session->userdata('user_id'));

            // $this->load->view('backend/input_user', $data);
        }
    }

    public function simpan()
    {
        $data = array(

            'nip' => $this->input->post("nip"),
            'nama_user' => $this->input->post("nama_user"),
            'username' => $this->input->post("username"),
            'password' => $this->input->post("password"),
            'jenis_kelamin' => $this->input->post("jenis_kelamin"),
            'tempat_lahir' => $this->input->post("tempat_lahir"),
            'tgl_lahir' => $this->input->post("tgl_lahir"),
            'no_hp' => $this->input->post("no_hp"),
            'email' => $this->input->post("email"),
            'jabatan' => $this->input->post("jabatan"),
            'alamat' => $this->input->post("alamat")

        );
        $keterangan = "Menambah data user";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->user_model->simpan($data) && $this->create_log($email, $keterangan)) {
            redirect('admin/user/');
        }
    }

    public function edit($user_id)
    {
        $row = $this->akun_model->get_user_by_id($user_id);
        foreach ($row as $row1) {
            $data['province_id'] = $row1->province_id;
            $data['regency_id'] = $row1->regency_id;
            $data['district_id'] = $row1->district_id;
            $data['jenis_kelamin'] = $row1->jenis_kelamin;
        }
        $data['province'] =  $this->akun_model->get_all_province();
        $data['user'] =  $this->akun_model->get_user_by_id($user_id);
        $data['dd_province'] = $this->akun_model->get_all_province();
        $data['dd_regency'] =  $this->akun_model->get_regency_by_id($data['province_id']);
        $data['dd_district'] =  $this->akun_model->get_district_by_id($data['regency_id']);
        $data['company'] = $this->company_profile_model->ambil_company_id('1');

        // $data['user'] = $this->user_model->get_user_id($user_id);

        $this->load->view('backend/user/edit', $data);
    }

    public function updated()
    {
        $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|max_length[64]');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|is_natural|max_length[2]');
        $this->form_validation->set_rules('alamat', 'Alamat utama', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('kode_pos', 'Kode pos utama', 'trim|required|is_natural|max_length[8]');

        // $id['id_pengguna'] = $this->input->post("id_pengguna");
        $data = array(

            // 'id_pengguna'     => set_value('id_pengguna'),
            'nama_depan'     => set_value('nama_depan'),
            'nama_belakang' => set_value('nama_belakang'),
            'nomor_telepon' => set_value('nomor_telepon'),
            'grup'            => set_value('grup'),
            'province_id'    => set_value('provinsi'),
            'regency_id'    => set_value('kota'),
            'district_id'    => set_value('kecamatan'),
            'tanggal_lahir'    => set_value('tanggal_lahir'),
            'jenis_kelamin'    => set_value('jenis_kelamin'),
            'alamat'         => set_value('alamat'),
            'kode_pos'         => set_value('kode_pos')

        );

        if ($this->user_model->update($data, $id)) {
            redirect('user');
        }
    }

    public function delete($id)
    {
        $keterangan = "Menghapus data user";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->user_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/user');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $keterangan = "Keluar dari Sistem";
        $email = $this->session->userdata('email');
        //   $nip = $this->session->userdata('nip');
        $this->create_log($email, $keterangan);
        redirect('login');
    }
}
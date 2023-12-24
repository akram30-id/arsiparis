<?php


defined('BASEPATH') or exit('No direct script is allowed');


class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    private function _get_all_users()
    {
        $users = $this->db->select('a.*, b.username')
            ->from('tb_profiles AS a')
            ->join('tb_users AS b', 'a.user_id=b.user_id')
            ->order_by('a.created_at', 'DESC')
            ->get()->result();

        return $users;
    }


    private function _get_user_by_username($username)
    {
        $users = $this->db->get_where('tb_users', ['username' => $username])->result();
        return $users;
    }


    public function index()
    {
        $users = $this->_get_all_users();

        $data = [
            'view' => 'user/index',#content
            'title' => 'KELOLA DATA USERS',
            'users' => $users
        ];

        $this->view($data);
    }

    public function delete($id)
    {
        $delete = $this->db->delete('tb_users', ['user_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Data User");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Data User");
        }

        return redirect('user/index#content');
    }


    public function new()
    {
        $rooms = $this->db->get('tb_rooms')->result();

        $data = [
            'view' => 'user/new',
            'title' => 'Tambah Data User',
            'rooms' => $rooms
        ];

        $this->view($data);
    }


    public function add()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nik', 'NIK', 'is_unique[tb_profiles.nik]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fail', "NIK sudah ada.");
            return redirect('user/index#content');
        }

        try {
            $this->db->trans_begin();
            
            $this->db->insert('tb_users', [
                'username' => 'DBS' . $post['nik'],
                'password' => md5('db5_dBSJkt#2023_!nd0n$ia'),
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $user_id = $this->db->insert_id();

            $this->db->insert('tb_profiles', [
                'user_id' => $user_id,
                'name' => $post['nama'],
                'nik' => $post['nik'],
                'role' => $post['role'],
                'phone' => $post['nomor-telepon'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('fail', "Gagal Menambah User.");
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success', "Berhasil Tambah Data User");
            }

            return redirect('user/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function edit($nik)
    {
        $profile = $this->db->get_where('tb_profiles', ['nik' => $nik])->row();
        
        if (!$profile) {
            echo '<h1>404 - NOT FOUND</h1>';
            die();
        }

        $data = [
            'view' => 'user/update',#content
            'title' => 'UPDATE DATA USER',
            'profile' => $profile
        ];

        $this->view($data);
    }


    private function _reset_password($nik)
    {
        $user_id = $this->db->select('user_id')
            ->from('tb_profiles')
            ->where('nik', $nik)
            ->limit(1)
            ->get()->row();
        
        $user = $user_id->user_id;
        $userdata = $this->db->get_where('tb_users', ['user_id' => $user])->row();

        $this->db->trans_begin();
        $this->db->update('tb_users', ['password' => md5('db5_dBSJkt#2023_!nd0n$ia')], ['user_id' => $user]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function update($nik)
    {
        $post = $this->input->post();

        if (isset($post['reset'])) {
            $updatePassword = $this->_reset_password($nik);
            if ($updatePassword) {
                $this->session->set_flashdata('success', "Berhasil Reset Password User");
            } else {
                $this->session->set_flashdata('fail', "Gagal Reset Password User");
            }
            return redirect('user/index#content');
        }

        try {
            $this->db->update('tb_profiles', [
                'name' => $post['nama'],
                'nik' => $nik,
                'role' => $post['role'],
                'phone' => $post['nomor-telepon'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['nik' => $nik]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('fail', "Gagal Update User.");
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success', "Berhasil Update Data User");
            }

            return redirect('user/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function user_detail($code)
    {
        $boxes = $this->db->get_where('tb_boxes', ['user_code' => $code])->result();

        $data = [
            'view' => 'user/detail',#content
            'title' => 'DETAIL RAK EXISTING #' . $code,
            'boxes' => $boxes,
        ];

        $this->view($data);   
    }

}
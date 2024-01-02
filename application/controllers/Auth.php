<?php

defined('BASEPATH') or exit('No direct script is allowed');


class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $post = $this->input->post();

        try {
            $username = $post['username'];
            $password = md5('db5_' . $post['password'] . '_!nd0n$ia');

            $getLogin = $this->db->get_where('tb_users', ['username' => $username, 'password' => $password])->row();

            if (!$getLogin) {
                $this->session->set_flashdata('login_failed', true);
                return redirect('auth/index');
            }

            $this->session->set_userdata('token', date('Ymd-H:i:s') . 'd!$P0Ra');

            $userData = $this->db->select('tu.username, tp.name, tp.nik, tp.role')
                ->from('tb_users AS tu')
                ->join('tb_profiles AS tp', 'tp.user_id=tu.user_id')
                ->where('tu.username', $username)
                ->limit(1)
                ->get()->row();

            $this->session->set_userdata('user', $userData);

            return redirect('home');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function signout()
    {
        try {
            $this->session->sess_destroy();

            $this->session->set_flashdata('logout_success', true);
            return redirect('auth/index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    
    public function reset()
    {
        $post = $this->input->post();
        
        $username = $this->session->user->username;
        $oldPassword = $post['old-password'];
        $newPassword = $post['new-password'];
        $confirmPassword = $post['confirm-password'];

        $cekPassword = $this->db->select('password')
            ->from('tb_users')
            ->where('username', $username)
            ->where('password', md5('db5_' . $oldPassword . '_!nd0n$ia'))
            ->limit(1)
            ->get()->row();


        if (!$cekPassword) {
            $this->session->set_flashdata('fail', "Password Lama Salah");
            return redirect('user/index#content');
        }


        if ($newPassword != $confirmPassword) {
            $this->session->set_flashdata('fail', "Password Baru dan Konfirmasi Password Tidak Sesuai");
            return redirect('user/index#content');
        }


        $this->db->trans_begin();
        $this->db->update('tb_users', ['password' => md5('db5_' . $newPassword . '_!nd0n$ia')], ['username' => $username]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', "Gagal Ubah Password. (INTERNAL SERVER ERROR)");
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', "Password Berhasil Diubah");
        }
        
        return redirect('user/index#content');
    }
}

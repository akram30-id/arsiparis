<?php

defined('BASEPATH') or exit('No direct script is allowed');


class Box extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_auth();
        $this->load->library('form_validation');
    }

    private function _get_all_boxes()
    {
        $boxes = $this->db->get('tb_boxes')->result();
        return $boxes;
    }


    private function _get_box_by_code($code)
    {
        $box = $this->db->get_where('tb_boxes', ['box_code' => $code])->result();
        return $box;
    }


    public function index()
    {
        $boxes = $this->_get_all_boxes();

        $data = [
            'view' => 'box/index',#content
            'title' => 'KELOLA DATA BOX',
            'boxes' => $boxes
        ];

        $this->view($data);
    }

    public function delete($id)
    {
        if($this->_restrict_role_nonadmin() == false) return false;

        $delete = $this->db->delete('tb_boxes', ['box_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Data Box");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Data Box");
        }

        return redirect('box/index#content');
    }


    public function new()
    {
        $this->_restrict_role_nonleader();

        $rak = $this->db->get('tb_shelfs')->result();

        $data = [
            'view' => 'box/new',
            'title' => 'Tambah Data Box',
            'shelfs' => $rak
        ];

        $this->view($data);
    }


    public function add()
    {
        $this->_restrict_role_nonleader();

        $post = $this->input->post();

        if (isset($post['kode-box'])) {
            if (in_array($post['kode-box'], ['', null])) {
                $post['kode-box'] = 'BOXDBS' . date('YmdHis');
            }
        }

        $this->form_validation->set_rules('kode-box', 'Kode Box', 'is_unique[tb_boxes.box_code]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fail', "Kode Box sudah ada.");
            return redirect('box/index#content');
        }

        try {
            $this->db->insert('tb_boxes', [
                'box_code' => $post['kode-box'],
                'shelf_code' => $post['kode-rak'],
                'capacity' => $post['kapasitas'],
                'description' => $post['deskripsi-box'],
                'status' => $post['status-box'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $this->session->set_flashdata('success', "Berhasil Tambah Data Box");

            return redirect('box/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function edit($id)
    {
        $this->_restrict_role_nonleader();

        $box = $this->db->get_where('tb_boxes', ['box_id' => $id])->row();
        $rak = $this->db->get('tb_shelfs')->result();

        $data = [
            'view' => 'box/update',#content
            'title' => 'UPDATE DATA BOX EXISTING',
            'box' => $box,
            'shelfs' => $rak
        ];

        $this->view($data);
    }


    public function update($box_code)
    {
        $this->_restrict_role_nonleader();

        $post = $this->input->post();

        try {
            $this->db->update('tb_boxes', [
                'shelf_code' => $post['kode-rak'],
                'capacity' => $post['kapasitas'],
                'description' => $post['deskripsi-box'],
                'status' => $post['status-box'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['box_code' => $box_code]);

            $this->session->set_flashdata('success', "Berhasil Update Data Box");

            return redirect('box/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


}
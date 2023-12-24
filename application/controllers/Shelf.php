<?php


defined('BASEPATH') or exit('No direct script is allowed');


class Shelf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    private function _get_all_shelfs()
    {
        $shelfs = $this->db->select('a.*, b.category_name')
            ->from('tb_shelfs AS a')
            ->join('tb_shelf_categories AS b', 'a.category_id=b.shelf_category_id')
            ->order_by('created_at', 'DESC')
            ->get()->result();

        return $shelfs;
    }


    private function _get_shelf_by_code($code)
    {
        $box = $this->db->get_where('tb_shelfs', ['shelf_code' => $code])->result();
        return $box;
    }


    public function index()
    {
        $shelfs = $this->_get_all_shelfs();

        $data = [
            'view' => 'shelf/index',#content
            'title' => 'KELOLA DATA RAK',
            'shelfs' => $shelfs
        ];

        $this->view($data);
    }

    public function delete($id)
    {
        $delete = $this->db->delete('tb_shelfs', ['shelf_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Data Rak");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Data Rak");
        }

        return redirect('shelf/index#content');
    }


    public function new()
    {
        $rooms = $this->db->get('tb_rooms')->result();

        $data = [
            'view' => 'shelf/new',
            'title' => 'Tambah Data Rak',
            'rooms' => $rooms
        ];

        $this->view($data);
    }


    public function add()
    {
        $post = $this->input->post();

        if (isset($post['kode-rak'])) {
            if (in_array($post['kode-rak'], ['', null])) {
                $post['kode-rak'] = 'SHLFDBS' . date('YmdHis');
            }
        }

        $this->form_validation->set_rules('kode-rak', 'Kode Rak', 'is_unique[tb_shelfs.shelf_code]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fail', "Kode Rak sudah ada.");
            return redirect('shelf/index#content');
        }

        try {
            $this->db->insert('tb_shelfs', [
                'shelf_code' => $post['kode-rak'],
                'room_code' => $post['kode-room'],
                'shelf_name' => $post['nama-rak'],
                'description' => $post['deskripsi-rak'],
                'status' => $post['status-rak'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $this->session->set_flashdata('success', "Berhasil Tambah Data Rak");

            return redirect('shelf/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function edit($id)
    {
        $shelf = $this->db->get_where('tb_shelfs', ['shelf_id' => $id])->row();
        $rooms = $this->db->get('tb_rooms')->result();
        $categories = $this->db->get('tb_shelf_categories')->result();

        $data = [
            'view' => 'shelf/update',#content
            'title' => 'UPDATE DATA RAK EXISTING',
            'shelf' => $shelf,
            'rooms' => $rooms,
            'categories' => $categories
        ];

        $this->view($data);
    }


    public function update($shelf_code)
    {
        $post = $this->input->post();

        try {
            $this->db->update('tb_shelfs', [
                'shelf_name' => $post['nama-rak'],
                'room_code' => $post['kode-room'],
                'category_id' => $post['kategori'],
                'description' => $post['deskripsi-rak'],
                'status' => $post['status-rak'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['shelf_code' => $shelf_code]);

            $this->session->set_flashdata('success', "Berhasil Update Data Rak");

            return redirect('shelf/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function shelf_detail($code)
    {
        $boxes = $this->db->get_where('tb_boxes', ['shelf_code' => $code])->result();

        $data = [
            'view' => 'shelf/detail',#content
            'title' => 'DETAIL RAK EXISTING #' . $code,
            'boxes' => $boxes,
        ];

        $this->view($data);   
    }

}
<?php

class Building extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->_auth();
    }


    public function index()
    {
        $buildings = $this->db->get('tb_buildings')->result();

        $data = [
            'view' => 'building/index',#content
            'title' => 'KELOLA GEDUNG ARSIP',
            'buildings' => $buildings
        ];

        $this->view($data);
    }


    public function edit($id)
    {
        $this->_restrict_role_nonadmin();

        $buildings = $this->db->get_where('tb_buildings', ['building_id' => $id])->row();

        $data = [
            'view' => 'building/update',#content
            'title' => 'KELOLA GEDUNG ARSIP',
            'buildings' => $buildings
        ];

        $this->view($data);
    }


    public function update($id)
    {
        $this->_restrict_role_nonadmin();

        $post = $this->input->post();

        try {
            $this->db->update('tb_buildings', [
                'building_name' => $post['nama-gedung'],
                'description' => $post['deskripsi-gedung'],
                'address' => $post['alamat-gedung'],
                'status' => $post['status-gedung'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['building_id' => $id]);

            $this->session->set_flashdata('success', "Berhasil Update Data Gedung");

            return redirect('building/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function delete($id)
    {
        if($this->_restrict_role_nonadmin() == false) return false;

        try {
            $delete = $this->db->delete('tb_buildings', ['building_id' => $id]);

            if (!$delete) {
                $this->session->flashdata('fail', 'Gagal Menghapus Data Gedung');
            }

            $this->session->set_flashdata('success', 'Berhasil Menghapus Gedung');

            return redirect('building/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function new()
    {
        $this->_restrict_role_nonadmin();

        $data = [
            'view' => 'building/new',
            'title' => 'Tambah Gedung Baru'
        ];

        $this->view($data);
    }

    public function add()
    {
        $this->_restrict_role_nonadmin();

        $post = $this->input->post();

        if (isset($post['kode-gedung'])) {
            if (in_array($post['kode-gedung'], ['', null])) {
                $post['kode-gedung'] = 'DBSBLD' . date('YmdHis');
            }
        }
        
        $this->db->trans_begin();
        $this->db->insert('tb_buildings', [
            'building_name' => $post['nama-gedung'],
            'building_code' => $post['kode-gedung'],
            'description' => $post['deskripsi-gedung'],
            'address' => $post['alamat-gedung'],
            'status' => $post['status-gedung'],
            'created_at' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->user->username
        ]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', "Gagal Tambah Data Gedung @serverError");
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', "Berhasil Tambah Data Gedung");
        }

        return redirect('building/index#content#content');
    }
}

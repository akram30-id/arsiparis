<?php 

defined('BASEPATH') or exit('No direct script is allowed');


class Unit extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->_auth();

        $this->load->library('form_validation');
    }


    private function _get_all_units()
    {
        $units = $this->db->select('a.*')
            ->from('tb_units AS a')
            ->order_by('a.created_at', 'DESC')
            ->get()->result();

        return $units;
    }


    private function _get_room_by_code($code)
    {
        $box = $this->db->get_where('tb_units', ['room_code' => $code])->result();
        return $box;
    }


    public function index()
    {
        $units = $this->_get_all_units();

        $data = [
            'view' => 'unit/index',#content
            'title' => 'KELOLA DATA UNIT',
            'units' => $units
        ];

        $this->view($data);
    }

    public function delete($id)
    {
        if ($this->_restrict_role_nonadmin() == false) return false;

        $delete = $this->db->delete('tb_units', ['unit_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Data Unit");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Data Unit");
        }

        return redirect('unit/index#content');
    }


    public function new()
    {
        $this->_restrict_role_nonadmin();

        $units = $this->db->get('tb_units')->result();
        $buildings = $this->db->get('tb_buildings')->result();

        $data = [
            'view' => 'unit/new',
            'title' => 'Tambah Data Unit Kerja',
            'units' => $units,
            'buildings' => $buildings
        ];

        $this->view($data);
    }


    public function add()
    {
        $this->_restrict_role_nonadmin();

        $post = $this->input->post();

        if (isset($post['kode-unit'])) {
            if (in_array($post['kode-unit'], ['', null])) {
                $post['kode-unit'] = 'UNITDBS' . date('YmdHis');
            }
        }

        $this->form_validation->set_rules('kode-unit', 'Kode Unit', 'is_unique[tb_units.room_code]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fail', "Kode Unit sudah ada.");
            return redirect('unit/index#content');
        }

        try {
            $this->db->insert('tb_units', [
                'unit_name' => $post['nama-unit'],
                'unit_code' => $post['kode-unit'],
                'description' => $post['deskripsi'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $this->session->set_flashdata('success', "Berhasil Tambah Data Unit");

            return redirect('unit/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function edit($id)
    {
        $this->_restrict_role_nonadmin();

        $unit = $this->db->get_where('tb_units', ['unit_id' => $id])->row();

        $data = [
            'view' => 'unit/update',#content
            'title' => 'UPDATE DATA UNIT KERJA',
            'unit' => $unit
        ];

        $this->view($data);
    }


    public function update($unit_code)
    {
        $this->_restrict_role_nonadmin();
        
        $post = $this->input->post();

        try {
            $this->db->update('tb_units', [
                'unit_name' => $post['nama-unit'],
                'description' => $post['deskripsi'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['unit_code' => $unit_code]);

            $this->session->set_flashdata('success', "Berhasil Update Data Unit");

            return redirect('unit/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function room_detail($code)
    {
        $shelfs = $this->db->get_where('tb_shelfs', ['shelf_code' => $code])->result();

        $data = [
            'view' => 'unit/detail',#content
            'title' => 'DETAIL RUANGAN EXISTING #' . $code,
            'shelfs' => $shelfs,
        ];

        $this->view($data);   
    }


}

?>
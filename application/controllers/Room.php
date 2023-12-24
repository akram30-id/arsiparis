<?php 

defined('BASEPATH') or exit('No direct script is allowed');


class Room extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->_auth();

        $this->load->library('form_validation');
    }


    private function _get_all_rooms()
    {
        $rooms = $this->db->select('a.*, b.building_name')
            ->from('tb_rooms AS a')
            ->join('tb_buildings AS b', 'a.building_code=b.building_code')
            ->order_by('a.created_at', 'DESC')
            ->get()->result();
        return $rooms;
    }


    private function _get_room_by_code($code)
    {
        $box = $this->db->get_where('tb_rooms', ['room_code' => $code])->result();
        return $box;
    }


    public function index()
    {
        $rooms = $this->_get_all_rooms();

        $data = [
            'view' => 'room/index',#content
            'title' => 'KELOLA DATA RUANGAN',
            'rooms' => $rooms
        ];

        $this->view($data);
    }

    public function delete($id)
    {
        $delete = $this->db->delete('tb_rooms', ['room_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Data Ruangan");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Data Ruangan");
        }

        return redirect('room/index#content');
    }


    public function new()
    {
        $rooms = $this->db->get('tb_rooms')->result();
        $buildings = $this->db->get('tb_buildings')->result();

        $data = [
            'view' => 'room/new',
            'title' => 'Tambah Data Ruangan',
            'rooms' => $rooms,
            'buildings' => $buildings
        ];

        $this->view($data);
    }


    public function add()
    {
        $post = $this->input->post();

        if (isset($post['kode-ruangan'])) {
            if (in_array($post['kode-ruangan'], ['', null])) {
                $post['kode-ruangan'] = 'ROOMDBS' . date('YmdHis');
            }
        }

        $this->form_validation->set_rules('kode-ruangan', 'Kode Ruangan', 'is_unique[tb_rooms.room_code]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fail', "Kode Ruangan sudah ada.");
            return redirect('room/index#content');
        }

        try {
            $this->db->insert('tb_rooms', [
                'room_name' => $post['nama-ruangan'],
                'room_code' => $post['kode-ruangan'],
                'building_code' => $post['kode-building'],
                'description' => $post['deskripsi-ruangan'],
                'status' => $post['status-ruangan'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $this->session->set_flashdata('success', "Berhasil Update Data Ruangan");

            return redirect('room/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function edit($id)
    {
        $room = $this->db->get_where('tb_rooms', ['room_id' => $id])->row();
        $buildings = $this->db->get('tb_buildings')->result();

        $data = [
            'view' => 'room/update',#content
            'title' => 'UPDATE DATA RUANGAN EXISTING',
            'room' => $room,
            'buildings' => $buildings
        ];

        $this->view($data);
    }


    public function update($room_code)
    {
        $post = $this->input->post();

        try {
            $this->db->update('tb_rooms', [
                'room_name' => $post['nama-ruangan'],
                'building_code' => $post['kode-building'],
                'description' => $post['deskripsi-ruangan'],
                'status' => $post['status-ruangan'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ], ['room_code' => $room_code]);

            $this->session->set_flashdata('success', "Berhasil Update Data Ruangan");

            return redirect('room/index#content');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function room_detail($code)
    {
        $shelfs = $this->db->get_where('tb_shelfs', ['shelf_code' => $code])->result();

        $data = [
            'view' => 'room/detail',#content
            'title' => 'DETAIL RUANGAN EXISTING #' . $code,
            'shelfs' => $shelfs,
        ];

        $this->view($data);   
    }


}

?>
<?php 

defined('BASEPATH') or exit('No direct script is allowed');

class Storage extends CI_Controller
{

    private function _get_last_boxes()
    {
        $last_boxes = $this->db->select('box_code, created_at')
            ->from('tb_boxes')
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()->row();

        return $last_boxes;
    }

    private function _get_last_shelfs()
    {
        $last_shelfs = $this->db->select('shelf_name, created_at')
            ->from('tb_shelfs')
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()->row();

        return $last_shelfs;
    }

    private function _get_last_rooms()
    {
        $last_rooms = $this->db->select('room_name, created_at')
            ->from('tb_rooms')
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()->row();

        return $last_rooms;
    }


    private function _get_last_units()
    {
        $last_units = $this->db->select('unit_name, created_at')
            ->from('tb_units')
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()->row();

        return $last_units;
    }


    public function index()
    {
        $data = [];

        $last_boxes = $this->_get_last_boxes();
        $data['last_box'] = $last_boxes;

        $last_shelfs = $this->_get_last_shelfs();
        $data['last_shelf'] = $last_shelfs;

        $last_rooms = $this->_get_last_rooms();
        $data['last_room'] = $last_rooms;

        $last_units = $this->_get_last_units();
        $data['last_unit'] = $last_units;

        $data = [
            'view' => 'storage/index',#content
            'title' => 'KELOLA PENYIMPANAN ARSIP',
            'data' => $data
        ];

        $this->view($data);
    }

}

?>
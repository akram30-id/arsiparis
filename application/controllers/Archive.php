<?php 

defined('BASEPATH') or exit('No direct script is allowed');

# update to repo
class Archive extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->_auth();

        $this->load->library('form_validation');
        $this->load->library('upload');
    }


    private function _get_all_documents()
    {
        $units = $this->db->select('a.*, b.unit_name, c.category_name')
            ->from('tb_documents AS a')
            ->join('tb_units AS b', 'a.unit_code=b.unit_code', 'left')
            ->join('tb_categories AS c', 'a.category_code=c.category_code')
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
        $data = [
            'view' => 'archive/index',#content
            'title' => 'KELOLA ARSIP'
        ];

        $this->view($data);
    }


    public function document()
    {
        $documents = $this->_get_all_documents();

        $data = [
            'view' => 'archive/documents',#content
            'title' => 'KELOLA DATA DOKUMEN',
            'documents' => $documents
        ];

        $this->view($data);
    }

    public function document_delete($id)
    {
        $getFileName = $this->db->select('file')
            ->from('tb_documents')
            ->where('document_id', $id)
            ->limit(1)
            ->get()->row();

        if ($getFileName != null) { // hapus file uploadan nya dulu
            unlink(FCPATH . 'assets/upload/' . $getFileName->file);
        }

        // apus data di db
        $delete = $this->db->delete('tb_documents', ['document_id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', "Berhasil Hapus Dokumen");
        } else {
            $this->session->set_flashdata('fail', "Gagal Hapus Dokumen");
        }

        return redirect('archive/document#content');
    }


    public function document_new()
    {
        // var_dump(FCPATH . 'assets\upload');
        // die();
        $units = $this->db->get('tb_units')->result();
        $categories = $this->db->get('tb_categories')->result();

        $data = [
            'view' => 'archive/document_new',
            'title' => 'Tambah Dokumen',
            'units' => $units,
            'categories' => $categories
        ];

        $this->view($data);
    }


    public function document_add()
    {
        $post = $this->input->post();

        if (in_array($_FILES['file_document']['name'], ['', null])) {
            $new_data = [
                'document_no' => $post['document-no'],
                'title' => $post['title'],
                'unit_code' => $post['unit'] == "" ? null : $post['unit'],
                'category_code' => $post['kategori'],
                'subject' => $post['subjek'],
                'description' => $post['deskripsi'],
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ];
        } else {
            $config['upload_path'] = FCPATH . 'assets/upload/';
            $config['allowed_types'] = 'pdf|docx';
            $config['file_name'] = md5(date('Y-m-d H:i:s'));
            $config['max_size'] = 2048; // 2MB

            // $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_document')) {
                $this->session->set_flashdata('fail', 'Upload File Error: ' . $this->upload->display_errors());
                return redirect('archive/document_new#content');
            } else {
                $uploaded_data = $this->upload->data();

                $new_data = [
                    'file' => $uploaded_data['file_name'],
                    'document_no' => $post['document-no'],
                    'title' => $post['title'],
                    'unit_code' => $post['unit'] == "" ? null : $post['unit'],
                    'category_code' => $post['kategori'],
                    'subject' => $post['subjek'],
                    'description' => $post['deskripsi'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'added_by' => $this->session->user->username
                ];
            }
        }

        $this->db->trans_begin();
        $this->db->insert('tb_documents', $new_data);

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('fail', 'Internal Server Error');
            return redirect('archive/document#content');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Berhasil Menambahkan Dokumen');
            return redirect('archive/document#content');
        }
    }


    public function document_edit($id)
    {
        $units = $this->db->get('tb_units')->result();
        $categories = $this->db->get('tb_categories')->result();
        $document = $this->db->get_where('tb_documents', ['document_id' => $id])->row();

        $data = [
            'view' => 'archive/document_update',
            'title' => 'Update Dokumen',
            'units' => $units,
            'categories' => $categories,
            'document' => $document
        ];

        $this->view($data);
    }


    public function document_update($id)
    {
        $post = $this->input->post();
        $oldFile = $post['old-file'];
        $new_data = null;

        if (in_array($_FILES['file_document']['name'], [null, ""])) { // jika gada file yg diupdate

            $new_data = [
                'title' => $post['title'],
                'unit_code' => $post['unit'] == "" ? null : $post['unit'],
                'category_code' => $post['kategori'],
                'subject' => $post['subjek'],
                'description' => $post['deskripsi'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->user->username
            ];
        } else { // jika ada update file baru

            unlink(FCPATH . 'assets/upload/' . $oldFile); // delete old file

            $config['upload_path'] = FCPATH . 'assets/upload/';
            $config['allowed_types'] = 'pdf|docx';
            $config['file_name'] = md5(date('Y-m-d H:i:s'));
            $config['max_size'] = 2048; // 2MB

            // $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_document')) {
                $this->session->set_flashdata('fail', 'Upload File Error: ' . $this->upload->display_errors());
                return redirect('archive/document_edit/' . $id . '#content');
            } else {
                $uploaded_data = $this->upload->data();

                $new_data = [
                    'file' => $uploaded_data['file_name'],
                    'title' => $post['title'],
                    'unit_code' => $post['unit'] == "" ? null : $post['unit'],
                    'category_code' => $post['kategori'],
                    'subject' => $post['subjek'],
                    'description' => $post['deskripsi'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'added_by' => $this->session->user->username
                ];
            }

        }

        if ($new_data == null) {
            $this->session->set_flashdata('fail', 'No Data Updated. Scripting Error (503)');
            return redirect('archive/document#content');
        }

        $this->db->trans_begin();
        $this->db->update('tb_documents', $new_data, ['document_id' => $id]);

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('fail', 'Internal Server Error');
            return redirect('archive/document#content');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Berhasil Mengupdate Dokumen');
            return redirect('archive/document#content');
        }
    }



    /** 
     * ===================================================================================================================
     * END OF METHOD FOR HANDLING DOCUMENT
     * START OF METHOD HANDLING KELOLA ARSIP
     * ===================================================================================================================
     * */


    public function archive()
    {
        $archives = $this->db->select('a.*, b.shelf_name, c.unit_name, d.name')
            ->from('tb_archives AS a')
            ->join('tb_shelfs AS b', 'a.shelf_code=b.shelf_code', 'left')
            ->join('tb_units AS c', 'a.unit_code=c.unit_code', 'left')
            ->join('tb_profiles AS d', 'a.archived_by=d.nik', 'left')
            ->order_by('a.created_at', 'DESC')
            ->get()->result();

        $data = [
            'view' => 'archive/archive',
            'title' => 'Kelola Data Arsip',
            'archives' => $archives
        ];

        $this->view($data);
    }

    public function archive_new()
    {
        $units = $this->db->get('tb_units')->result();

        $data = [
            'view' => 'archive/archive_new',
            'title' => 'Tambah Arsip',
            'units' => $units
        ];

        $this->view($data);
    }


    public function archive_add()
    {

        $post = $this->input->post();

        // echo '<pre>';
        // print_r($post);
        // die();

        if (!isset($post['kode-arsip']) || in_array($post['kode-arsip'], ['', null])) {
            $post['kode-arsip'] = 'DBSARC' . date('YmdHis');
        }

        $archived_by = $this->db->select('a.nik')
            ->from('tb_profiles AS a')
            ->join('tb_users AS b', 'a.user_id=b.user_id')
            ->where('b.username', $this->session->user->username)
            ->limit(1)
            ->get()->row();

        $archived_by = $archived_by->nik;

        $this->db->trans_begin();
        $this->db->insert('tb_archives', [
            'archive_code' => $post['kode-arsip'],
            'archive_title' => $post['judul-arsip'],
            'retention_date' => $post['tanggal-retensi'] ?? null,
            'retention_type' => $post['jadwal-retensi'] ?? null,
            'storage' => $post['penyimpanan'],
            'archive_status' => $post['status'],
            'archived_by' => $archived_by,
            'description' => $post['deskripsi'],
            'created_at' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->user->username
        ]);

        $last_id = $this->db->insert_id();

        // var_dump($last_id);
        // die();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', 'GAGAL MENAMBAHKAN ARSIP. @DB ERROR');
        } else {
            $this->db->trans_commit();

            if ($post['penyimpanan'] == 'RAK') {
                return redirect('archive/assign_rak/' . $last_id . '#content');
            } else if ($post['penyimpanan'] == 'BOX') {
                return redirect('archive/assign_box/' . $last_id . '#content');
            } else {
                $this->session->set_flashdata('success', 'BERHASIL MENAMBAHKAN ARSIP.');
                return redirect('archive/archive#content');
            }
        }

    }


    public function show_profiles()
    {
        $get = $this->input->get();

        if (isset($get['term'])) {
            $profiles = $this->db->select('name, nik')
                ->from('tb_profiles')
                ->like('name', $get['term'])
                ->or_like('nik', $get['term'])
                ->limit(3)
                ->get()->result();

            if (count($profiles) > 0) {
                foreach ($profiles as $row) {
                    $result[] = $row->nik . ' - ' . $row->name;
                    echo json_encode($result);
                }
            }
        }


        return $profiles;
    }


    public function assign_rak($id)
    {
        $rooms = $this->db->get_where('tb_rooms', ['status' => 'ACTIVE'])->result();
        $archive = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        // echo '<pre>';
        // print_r($archive);
        // die();

        $data = [
            'view' => 'archive/assign_rak',
            'title' => 'Assign Arsip Kedalam Rak',
            'rooms' => $rooms,
            'archive_code' => $archive->archive_code,
            'archive_id' => $archive->archive_id,
        ];

        $this->view($data);
    }


    public function assign_box($id)
    {
        $rooms = $this->db->get_where('tb_rooms', ['status' => 'ACTIVE'])->result();
        $archive = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        // echo '<pre>';
        // print_r($archive);
        // die();

        $data = [
            'view' => 'archive/assign_box',
            'title' => 'Assign Arsip Kedalam Box',
            'rooms' => $rooms,
            'archive_code' => $archive->archive_code,
            'archive_id' => $archive->archive_id,
        ];

        $this->view($data);
    }


    public function assign_rak_add()
    {
        $post = $this->input->post();

        // echo '<pre>';
        // print_r($post);
        // die();

        $this->db->trans_start();
        $this->db->update('tb_archives', [
            'shelf_code' => $post['kode-rak']
        ], ['archive_id' => $post['id-arsip']]);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', "Gagal Assign Rak");
            return redirect('archive/assign_rak/' . $post['id-arsip'] . '#content');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', "Success Assign Rak");
            return redirect('archive/archive/#content');
        }
    }


    public function assign_box_add()
    {
        $post = $this->input->post();

        // echo '<pre>';
        // print_r($post);
        // die();

        $this->db->trans_start();
        $this->db->update('tb_archives', [
            'shelf_code' => $post['kode-rak'],
            'box_code' => $post['kode-box']
        ], ['archive_id' => $post['id-arsip']]);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', "Gagal Assign Box");
            return redirect('archive/assign_rak/' . $post['id-arsip'] . '#content');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', "Success Assign Box");
            return redirect('archive/archive/#content');
        }
    }


    public function get_shelf()
    {
        $get = $this->input->get();

        $shelfs = $this->db->select('shelf_code, shelf_name')
            ->from('tb_shelfs')
            ->where('room_code', $get['room_code'])
            ->get()->result();

        echo json_encode($shelfs);
    }


    public function get_box()
    {
        $get = $this->input->get();

        $boxes = $this->db->select('box_code')
            ->from('tb_boxes')
            ->where('shelf_code', $get['shelf_code'])
            ->get()->result();

        echo json_encode($boxes);
    }


    public function archive_edit($id)
    {
        $units = $this->db->get('tb_units')->result();
        $archive = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        $data = [
            'view' => 'archive/archive_edit',
            'title' => 'Update Detail Arsip',
            'units' => $units,
            'archive' => $archive
        ];

        $this->view($data);
    }


    public function archive_update($id)
    {

        $post = $this->input->post();

        // echo '<pre>';
        // print_r($post);
        // die();

        $archived_by = $this->db->select('a.nik')
            ->from('tb_profiles AS a')
            ->join('tb_users AS b', 'a.user_id=b.user_id')
            ->where('b.username', $this->session->user->username)
            ->limit(1)
            ->get()->row();

        $current_data = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        $archived_by = $archived_by->nik;

        // var_dump($current_data->archive_status);
        // var_dump($current_data->retention_date);
        // var_dump($current_data->retention_type);
        // die();

        $this->db->trans_begin();
        $this->db->update('tb_archives', [
            'archive_title' => $post['judul-arsip'],
            'unit_code' => $post['unit'],
            'storage' => $post['penyimpanan'],
            'archive_status' => isset($post['status']) ? $post['status'] : $current_data->archive_status,
            'retention_date' => isset($post['tanggal-retensi']) ? $post['tanggal-retensi'] : $current_data->retention_date,
            'retention_type' => isset($post['jadwal-retensi']) ? $post['jadwal-retensi'] : $current_data->retention_type,
            'archived_by' => $archived_by,
            'description' => $post['deskripsi'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->user->username
        ], ['archive_id' => $id]);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', 'GAGAL MENAMBAHKAN ARSIP. @DB ERROR');
        } else {
            $this->db->trans_commit();

            if ($post['penyimpanan'] == 'RAK') {
                $rak = $current_data->shelf_code;
                if (in_array($rak, [null, ""])) { // arsip dipindahin ke rak
                    return redirect('archive/assign_rak/' . $id . '#content'); // assign rak
                }

                return redirect('archive/update_rak/' . $id . '#content'); // update rak
            } else if ($post['penyimpanan'] == 'BOX') {
                $box = $current_data->box_code;
                if (in_array($box, ['', null])) {
                    return redirect('archive/assign_box/' . $id . '#content');
                }
                return redirect('archive/update_box/' . $id . '#content');
            } else {
                $this->session->set_flashdata('success', 'BERHASIL MENG-UPDATE ARSIP.');
                return redirect('archive/archive#content');
            }
        }

    }



    public function update_rak($id)
    {
        $rooms = $this->db->get_where('tb_rooms', ['status' => 'ACTIVE'])->result();

        $archive = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        $shelf = $this->db->get_where('tb_shelfs', ['shelf_code' => $archive->shelf_code])->row();

        // echo '<pre>';
        // print_r($shelf->shelf_code . ' - ' . $shelf->shelf_name);
        // die();

        $data = [
            'view' => 'archive/update_rak',
            'title' => 'Update Rak Arsip',
            'rooms' => $rooms,
            'archive_room' => $shelf->room_code,
            'shelf' => $shelf->shelf_code . ' - ' . $shelf->shelf_name,
            'archive_code' => $archive->archive_code,
            'archive_id' => $archive->archive_id,
        ];

        $this->view($data);
    }


    public function update_box($id)
    {
        $rooms = $this->db->get_where('tb_rooms', ['status' => 'ACTIVE'])->result();
        $archive = $this->db->get_where('tb_archives', ['archive_id' => $id])->row();

        $shelf = $this->db->get_where('tb_shelfs', ['shelf_code' => $archive->shelf_code])->row();
        $box = $this->db->get_where('tb_boxes', ['box_code' => $archive->box_code])->row();

        // echo '<pre>';
        // print_r($shelf);
        // die();

        $data = [
            'view' => 'archive/update_box',
            'title' => 'Assign Arsip Kedalam Box',
            'rooms' => $rooms,
            'archive_room' => $shelf->room_code,
            'shelf' => $shelf->shelf_code . ' - ' . $shelf->shelf_name,
            'box' => $box->box_code,
            'archive_code' => $archive->archive_code,
            'archive_id' => $archive->archive_id,
        ];

        $this->view($data);
    }


    public function archive_assign($code)
    {
        $archive = $this->db->get_where('tb_archives', ['archive_code' => $code])->row();
        $documents = $this->db->select('a.*, b.unit_name, c.category_name')
            ->from('tb_documents AS a')
            ->join('tb_units AS b', 'a.unit_code=b.unit_code', 'left')
            ->join('tb_categories AS c', 'a.category_code=c.category_code')
            ->where('flag_assign', 0)
            ->order_by('a.created_at', 'DESC')
            ->get()->result();

        $data = [
            'view' => 'archive/archive_assign',
            'title' => 'Assign Dokumen Kedalam Arsip ' . $archive->archive_title,
            'archive' => $archive,
            'documents' => $documents
        ];

        $this->view($data);
    }


    public function archive_assign_add($code)
    {
        $post = $this->input->post();

        // var_dump($code);
        // var_dump($post['check-dokumen']);
        // die();

        $checked_documents = $post['check-dokumen'];

        foreach ($checked_documents as $document_assigned) {
            $this->db->trans_begin();
            $this->db->insert('tb_archive_documents', [
                'document_no' => $document_assigned,
                'archive_code' => $code,
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->user->username
            ]);

            $this->db->update('tb_documents', ['flag_assign' => 1], ['document_no' => $document_assigned]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                $this->session->set_flashdata('fail', 'GAGAL ASSIGN DOKUMEN.');
            } else {
                $this->db->trans_commit();

                $this->session->set_flashdata('success', 'BERHASIL ASSIGN DOKUMEN.');
            }
        }

        return redirect('archive/archive_assign/' . $code . '#content');
    }


    public function archive_detail()
    {
        
    }

}

?>
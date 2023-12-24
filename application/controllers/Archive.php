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

        $config['upload_path']          = FCPATH . 'assets/upload/';
		$config['allowed_types']        = 'pdf|docx';
		$config['file_name']            = md5(date('Y-m-d H:i:s'));
		$config['max_size']             = 2048; // 2MB

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

            $this->db->trans_begin();
            $this->db->insert('tb_documents', $new_data);

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('fail', 'Internal Server Error');
                return redirect('archive/document#content');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Berhasil Menambahkan Dokumen');
                return redirect('archive/document#content');
            }
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

            $config['upload_path']          = FCPATH . 'assets/upload/';
            $config['allowed_types']        = 'pdf|docx';
            $config['file_name']            = md5(date('Y-m-d H:i:s'));
            $config['max_size']             = 2048; // 2MB

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

        if ($this->db->trans_status() === FALSE) {
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

        $this->db->trans_begin();
        $this->db->insert('tb_archives', [
            'archive_code' => $post['kode-arsip'],
            'archive_title' => $post['judul-arsip'],
            'archive_status' => $post['status'],
            'description' => $post['deskripsi'],
            'created_at' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->user->username
        ]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('fail', 'GAGAL MENAMBAHKAN ARSIP. @DB ERROR');
        } else {
            $this->db->trans_commit();
            $last_id = $this->db->insert_id();

            if ($post['penyimpanan'] == 'RAK') {
                return redirect('assign_rak/' . $last_id . '#content');
            } else if ($post['penyimpanan'] == 'BOX') {
                return redirect('assign_box/' . $last_id . '#content');
            } else {
                $this->session->set_flashdata('success', 'BERHASIL MENAMBAHKAN ARSIP.');
                return redirect('archive/archive#content');
            }
        }

    }


    public function show_profiles()
    {
        $get = $this->input->get();

        $profiles = $this->db->select('name, nik')
            ->from('tb_profiles')
            ->like('name', $get['name'])
            ->get()->result();

        return $profiles;
    }


    public function update($unit_code)
    {
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
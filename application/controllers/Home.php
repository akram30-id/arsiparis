<?php 
defined('BASEPATH') or exit('No direct script is allowed');


class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('token')) {
            return redirect('auth/index');
        }
    }

    public function index()
    {
        $data = [
            // 'view' => 'home/index',
            'view' => 'home/index',
            'title' => 'HOME'
        ];

        $this->view($data);
    }

}


?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
        $name['userName'] = $this->session->userdata('nameUsers');
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['headerTamp'] = "Dashboard";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Dashboard/index.php');
        $this->load->view('Impression/Footer');
    }
}
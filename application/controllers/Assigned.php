<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assigned extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('userAccount');
    }

    public function index() {
        $name['userName'] = $this->session->userdata('nameUsers');
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['assignedFile'] = $this->userAccount->assignedView();
        $name['headerTamp'] = "Assigned Document";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Assigned/index.php');
        $this->load->view('Impression/Footer');
    }

    public function assignedDocument($id){
        $name['id'] = $this->userAccount->file($id);
        $name['userName'] = $this->session->userdata('nameUsers');
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['folderDoct'] = $this->userAccount->assignedFDoc($id);
        $name['headerTamp'] = "Assigned Document";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Assigned/fieldDoc.php');
        $this->load->view('Impression/Footer');
    }

    public function viewData($id)
    {
        $data['dataDocument'] = $this->userAccount->fileDocument($id);
        $this->load->view('Dashboard/viewDocument.php', $data);
    }
    
    public function viewDFolder($id)
    {
        $data['dataDFolder'] = $this->userAccount->file($id);
        $this->load->view('Dashboard/viewDFolder.php', $data);
    }
    public function insertDocument($id){

        $config['upload_path']          = './tamplate/documents/';
        $config['allowed_types']        = 'pdf|doc|docx|jpg|png|jpeg|csv|xlsx|xls|mp4';
        $config['max_size']             = 100048;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('documentFile')) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Uploaded Failed ! Please look at your File again something wrong
            </div>'
            );
            redirect('Assigned/assignedDocument/'. $id);
        } else {
            $fileDocument = $this->upload->data();
            $fileDocument = $fileDocument['file_name'];

            $icon = "fa-solid fa-file-contract";
            $user = $this->session->userdata('nameUsers');
            $date = date('Y-m-d H:i:s', time());

            $this->uploadFile['doc_name'] = $fileDocument;
            $this->uploadFile['doc_user'] = $user;
            $this->uploadFile['doc_folder'] = $id;
            $this->uploadFile['doc_desc'] = $this->input->post('descFile');
            $this->uploadFile['doc_icon'] = $icon;
            $this->uploadFile['doc_date'] = $date;
            
            $this->userAccount->insertDocument($this->uploadFile);
            redirect('Assigned/assignedDocument/'. $id);
        }
    }
}
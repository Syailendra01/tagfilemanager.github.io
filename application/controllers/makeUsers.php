<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class makeUsers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('userAccount');
    }

    public function index() {
        $name['userName'] = $this->session->userdata('nameUsers');
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['dataAccount'] = $this->userAccount->accountView();
        $name['headerTamp'] = "Users Account";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Login/users.php');
        $this->load->view('Impression/Footer');
    }

    public function insertAcccount()
    {
        $this->account['emailUsers'] = $this->input->post('emailUsers');
        $this->account['passwordUsers'] = md5($this->input->post('passwordUsers'));
        $this->account['nameUsers'] = $this->input->post('namaUsers');
        $this->account['diviUnits'] = $this->input->post('divition');
        $this->account['statusUsers'] = 1;
        $result =$this->userAccount->insertAccount($this->account);
        redirect('makeUsers/index');
    }

    public function editAccount()
    {
        $id = $this->input->post('idUser');

        $editCondition = $this->userAccount->dataAccount($id);
        $Email = $editCondition->emailUsers;
        $Password = $editCondition->passwordUsers;
        $nameUsers = $editCondition->nameUsers;
        $idUsers = $editCondition->idUsers;
        $outputMach = "";
        $outputMach .= "
            <input type='text' value='$idUsers' class='form-control' name='idAccount' hidden>
            <div class='form-group'>
                <label for='' >Email Users</label>
                <input type='email' class='form-control' name='emailUsers' value='$Email' required >
            </div>
            <div class='form-group'>
                <label for='' >Password Users</label>
                <input type='Password' class='form-control' name='passwordUsers' value='$Password' required >
            </div>
            <button type='submit' class='btn btn-success' style='font-size : 12px; letter-spacing: 1px;'><i class='fa-solid fa-pen-to-square' style='margin-right: 10px;'></i>Save</button>
            ";

        echo json_encode($outputMach);
    }

    public function upadateAccount()
    {
        $idAccount = $this->input->post('idAccount');

        $this->updateAccount['emailUsers'] = $this->input->post('emailUsers');
        $this->updateAccount['passwordUsers'] = md5($this->input->post('passwordUsers'));
                
        $this->userAccount->editAccount($idAccount, $this->updateAccount);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert"> Updated your account are successfully
            </div>'
        );
        redirect('makeUsers/index');
    }
    
    public function deleteAccount($id)
    {
        $result = $this->userAccount->deleteAccount($id);
        if ($result != null) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Deleted Success
              </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert"> Failed!
              </div>'
            );
        }
        redirect('makeUsers/index');
    }
}
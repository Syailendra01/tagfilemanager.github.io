<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('userAccount');
    }

	public function index()
	{
        $this->load->view('Login/index.php');
	}
	public function validasiAccount(){
		$usersEmail = $this->input->post('userEmail');
		$usersPassword = $this->input->post('userPassword');

		$validationLogin = $this->userAccount->validationLogin($usersEmail, md5($usersPassword));

		if ($validationLogin != null) {
			$emailUsers = $validationLogin->emailUsers;
			$passwordUsers = $validationLogin->passwordUsers;
			$nameUsers = $validationLogin->nameUsers;
			$unitDivition = $validationLogin->diviUnits;
			$statusUsers = $validationLogin->statusUsers;

			$this->session->set_userdata(array(
				'login' => true,
				'id' => $idUsers,
				'nameUsers' => $nameUsers,
				'unitDivition' => $unitDivition,
				'emailUsers' => $emailUsers,
				'passwordUsers' => $passwordUsers,
				'statusUsers' => $statusUsers
			));
			redirect('Dashboard');
		} else {
			$this->session->set_flashdata(
				'login',
				'<div style="font-size : 12px; width : 60%; height: 45px; letter-spacing: 0.5px;
				border-radius : 7px; background: red; color: white; margin-left : 20%; padding-top : 14px;"> 
				<span style="position : absolute; left: 23%; top : 52%;font-size: 28px;">!</span> Login Gagal | Cek kembali Email dan Password Anda
			  </div>'
			);
			redirect('Login');
		}
	}

	
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}

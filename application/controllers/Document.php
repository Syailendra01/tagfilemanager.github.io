<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->helper(array('url', 'download'));
        $this->load->model('userAccount');
    }

    public function index() {
        $users = $this->session->userdata('nameUsers');
        $name['userName'] = $users;
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['folderFile'] = $this->userAccount->folderFile($users);
        $name['headerTamp'] = "My Document";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Document/index.php');
        $this->load->view('Impression/Footer');
    }

    public function fileDocument($id){
        $users = $this->session->userdata('nameUsers');
        $name['id'] = $this->userAccount->file($id);
        $name['userName'] = $this->session->userdata('nameUsers');
        $name['divitionUnit'] = $this->session->userdata('unitDivition');
        $name['folderDoct'] = $this->userAccount->folderDocument($id, $users);
        $name['headerTamp'] = "My Document";
        $this->load->view('Impression/Header', $name);
        $this->load->view('Impression/Sidebar');
        $this->load->view('Document/fieldDoc.php');
        $this->load->view('Impression/Footer');
    }

    public function actionData(){
        $date = date('Y-m-d', time());
        if (isset($_POST['shareBtn'])) {
            if (!empty($this->input->post('checkedData'))) {
                $checkedStatus = $this->input->post('checkedData'); 
                for ($i=0; $i < sizeof($checkedStatus); $i++) { 
                    $data = array('sfdoc_sfid' => $checkedStatus[$i]);
                    $this->userAccount->shareFolder($data);
                }
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert"> Data has been successfully shared
                  </div>'
                );
                redirect('Document/index');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Please! Select atleast any Data
                </div>'
                );
                redirect('Document/index');
            }
        } else if (isset($_POST['downloadBtn'])) {

            if (!empty($this->input->post('checkedData'))) {
                $checkedData = $this->input->post('checkedData'); 
                $countData = count($checkedData);
                for ($i=0; $i < $countData ; $i++) { 
                    $checked_id = $checkedData[$i];
                    $result = $this->userAccount->downloadFile($checked_id);
                    foreach ($result as $key => $value) {
                        if ($value->folder_status == 2 ) {
                            force_download('./tamplate/documents/' . $value->folder_name, null);
                        } else if ($value->folder_status == 1) {
                            $user = $this->session->userdata('nameUsers');
                            $checkDocument = $this->userAccount->folderDocument($value->folder_id, $user);
                            foreach ($checkDocument as $key) {
                                $path = './tamplate/documents/' .$key->doc_name;
                                $this->zip->read_file($path);
                            }
                            $this->zip->download($value->folder_name. "|" .time(). '.zip');
                        }
                    }
                    
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Please! Select atleast any Data
                </div>'
                );
                redirect('Document/index');
            }

        }
    }


    public function actionDownload()
    {
        if (isset($_POST['downloadBtn'])) {
            if (!empty($this->input->post('checkedDocument'))) {
                $checkedDocuments = $this->input->post('checkedDocument');
                for ($i=0; $i < sizeof($checkedDocuments); $i++) { 
                    $checkStatus = $this->userAccount->getDocument($checkedDocuments);
                    foreach ($checkStatus as $key => $value) {
                        $path = './tamplate/documents/' .$value->doc_name;
                        $this->zip->read_file($path);
                    }
                    $this->zip->download("Documents Staging |" .time(). '.zip');

                }
            }
        }
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

    public function docDownload($id)
    {
        $downDocument = $this->userAccount->fileDocument($id);
        force_download('./tamplate/documents/' . $downDocument->doc_name, null);
    }
    public function folDownload($id)
    {
        $downfolDocument = $this->userAccount->file($id);
        force_download('./tamplate/documents/' . $downfolDocument->folder_name, null);
    }
    // CRUD Data 
    public function createFolder() {
        $icon = "fa-solid fa-folder";
        $user = $this->session->userdata('nameUsers');
        $date = date('Y-m-d H:i:s', time());
        $this->created['folder_name'] = $this->input->post('inputFolder');
        $this->created['folder_user'] = $user;
        $this->created['folder_status'] = 1;
        $this->created['folder_icon'] = $icon;
        $this->created['folder_created'] = $date;

        $this->userAccount->insertFolder($this->created);
        redirect('Document/index');
    }

    public function createDocument(){

        $config['upload_path']          = './tamplate/documents/';
        $config['allowed_types']        = 'pdf|doc|docx|jpg|png|jpeg|csv|xlsx|xls|mp4';
        $config['max_size']             = 100048;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('documentUpload')) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Uploaded Failed ! Please look at your File again something wrong
            </div>'
            );
            redirect('Document/index');
        } else {
            $uploadDoc = $this->upload->data();
            $uploadDoc = $uploadDoc['file_name'];

            $icon = "fa-solid fa-file-contract";
            $user = $this->session->userdata('nameUsers');
            $date = date('Y-m-d H:i:s', time());

            $this->uploadFile['folder_name'] = $uploadDoc;
            $this->uploadFile['folder_user'] = $user;
            $this->uploadFile['folder_status'] = 2;
            $this->uploadFile['folder_icon'] = $icon;
            $this->uploadFile['folder_created'] = $date;
            
            $this->userAccount->insertFolder($this->uploadFile);

            redirect('Document/index');
        }
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
            redirect('Document/fileDocument/'. $id);
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
            redirect('Document/fileDocument/'. $id);
        }
    }

    public function editCode(){

        $id = $this->input->post('id');

        $editCondition = $this->userAccount->file($id);
        $nameFolder = $editCondition->folder_name;
        $idFolder = $editCondition->folder_id;
        $statusFolder = $editCondition->folder_status;

        if ($statusFolder == 1) {
            $outputMach = "";
            $outputMach .= "
                <input type='text' value='$idFolder' class='form-control' name='idFolder' hidden>
                <div class='input-group mb-3'>
                <span class='input-group-text' style='cursor: default; font-size: 14px; letter-spacing: 0.5px;'>Folder Name</span>
                <input type='text' value='$nameFolder' class='form-control' aria-label='Sizing example input' name='editFolder' id='editFolder' required>
                </div>
    
                <button type='submit' class='btn btn-success' style='font-size : 12px; letter-spacing: 1px;'><i class='fa-solid fa-pen-to-square' style='margin-right: 7px;'></i>Save</button>
                ";
        } else {
            $outputMach = "";
            $outputMach .= "
                <input type='text' value='$idFolder' class='form-control' name='idFolder' hidden>
                <div class='form-group'>
                    <label style='margin-bottom : 15px;'>Previous document <span style='margin : 0 15px 0 10px;'>:</span> $nameFolder</label>
                    <input type='file' name='fileUpdated' id='fileUpdated' class='form-control' style='height: 45px'>   
                </div>
                <button type='submit' class='btn btn-success' style='font-size : 12px; letter-spacing: 1px;'><i class='fa-solid fa-pen-to-square' style='margin-right: 7px;'></i>Save</button>
                ";
        }

        echo json_encode($outputMach);
    }

    public function updateCode(){

        $id = $this->input->post('id');

        $upadateCondition = $this->userAccount->fileDocument($id);
        $nameDocument = $upadateCondition->doc_name;
        $idDocument = $upadateCondition->doc_id;
        $descDocument = $upadateCondition->doc_desc;

        $outputMach = "";
        $outputMach .= "
            <input type='text' value='$idDocument' class='form-control' name='idDocument' hidden>
            <div class='form-group col-9'>
                <label style='margin-bottom : 15px;'>Previous document <span style='margin : 0 15px 0 10px;'>:</span> $nameDocument</label>
                <input type='file' name='fileUpdated' id='fileUpdated' class='form-control' style='height: 45px' required>   
            </div>
            <div class='form-group col-11'>
                <label for=''>Description</label>
                <div class='form-floating'>
                    <textarea class='form-control' id='floatingTextarea' name='descFile' required>$descDocument</textarea>
                </div>
            </div>

            <button type='submit' class='btn btn-success' style='font-size : 12px; letter-spacing: 1px; margin: 10px 15px;'>
            <i class='fa-solid fa-pen-to-square' style='margin-right: 7px;'></i> Save </button>
            ";

        echo json_encode($outputMach);
    }

    public function editFolders(){
        $idData = $this->input->post('idFolder');
        $checkStatus = $this->userAccount->file($idData);

        if ($checkStatus->folder_status == 1) {
            $this->updateFolder['folder_name'] = $this->input->post('editFolder');
            $this->userAccount->editFolder($idData, $this->updateFolder);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Updated folder are successfully
              </div>'
            );
            redirect('Document/index');
        } else {

            unlink('./tamplate/documents/' . $checkStatus->folder_name);
            
            $config['upload_path']          = './tamplate/documents/';
            $config['allowed_types']        = 'pdf|doc|docx|jpg|png|jpeg|csv|xlsx|xls|mp4';
            $config['max_size']             = 100048;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('fileUpdated')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Update Failed ! Please look at your File again something wrong
                </div>'
                );
                redirect('Document/index');
            } else {
                $updateFile = $this->upload->data();
                $updateFile = $updateFile['file_name'];
    
                $this->updateFolder['folder_name'] = $updateFile;
                
                $this->userAccount->editFolder($idData, $this->updateFolder);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert"> Updated document are successfully
                  </div>'
                );
                redirect('Document/index');
            }
        }
    }

    public function updateDocument()
    {
        $idData = $this->input->post('idDocument');
        $checkStatus = $this->userAccount->fileDocument($idData);

        unlink('./tamplate/documents/' . $checkStatus->doc_name);
            
        $config['upload_path']          = './tamplate/documents/';
        $config['allowed_types']        = 'pdf|doc|docx|jpg|png|jpeg|csv|xlsx|xls|mp4';
        $config['max_size']             = 100048;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
            
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileUpdated')) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Update Failed ! Please look at your File again something wrong
            </div>'
            );
            redirect('Document/fileDocument/'. $checkStatus->doc_folder);
        } else {
            $updateFile = $this->upload->data();
            $updateFile = $updateFile['file_name'];
    
            $this->updateDocuments['doc_name'] = $updateFile;
            $this->updateDocuments['doc_desc'] = $this->input->post('descFile');
                
            $this->userAccount->editDocument($idData, $this->updateDocuments);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Updated documents are successfully
                </div>'
            );
            redirect('Document/fileDocument/'. $checkStatus->doc_folder);
        }

    }

    public function deleteFolder($id) {
        $data = $this->userAccount->file($id);

        if ($data->folder_status == 2) {
            $delete = $this->userAccount->file($id);
            unlink('./tamplate/documents/' . $delete->folder_name);
            $result = $this->userAccount->dalateFolder($id);
            if ($result != null) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert"> Deleted Success
                  </div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert"> Failed for Deleted Data 
                  </div>'
                );
            }
            redirect('Document/index');
        } else {
            $users = $this->session->userdata('nameUsers');
            $data = $this->userAccount->folderDocument($id, $users);
            foreach ($data as $key => $value) {
                unlink('./tamplate/documents/' . $value->doc_name);
            }
            $this->userAccount->dalateFolder($id);
            $this->userAccount->removeDocument($id);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert"> Deleted Success
                </div>'
            );
            redirect('Document/index');

        }
    }

    public function deleteDocument ($id) {
        $data = $this->userAccount->fileDocument($id);
        unlink('./tamplate/documents/' . $data->doc_name);
        $result = $this->userAccount->deleteDocument($id);
        if ($result != null) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Deleted Success
              </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert"> Failed for Deleted Data 
              </div>'
            );
        }
        redirect('Document/fileDocument/'. $data->doc_folder);
    }
}
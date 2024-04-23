<?php
class userAccount extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function validationLogin($usersEmail, $usersPassword)
    {
        $query = $this->db->query("SELECT * From usersaccount where emailUsers ='{$usersEmail}' AND passwordUsers ='{$usersPassword}' ");
        return $query->row();
    }

    function accountView()
    {
        $this->db->order_by('idUsers');
        $query = $this->db->get('usersaccount');
        return $query->result();
    }
    function dataAccount($id)
    {
        $this->db->where('idUsers', $id);
        $query = $this->db->get('usersaccount');
        return $query->row();
    }
    function folderFile($id)
    {
        $this->db->where('folder_user', $id);
        $this->db->order_by('folder_id');
        $query = $this->db->get('folders');
        return $query->result();
    }

    function assignedFDoc($id)
    {
        $this->db->where('doc_folder', $id);
        $this->db->order_by('doc_id');
        $query = $this->db->get('documents');
        return $query->result();
    }
    function folderDocument($id, $users)
    {
        $this->db->where('doc_folder', $id);
        $this->db->where('doc_user', $users);
        $this->db->order_by('doc_id');
        $query = $this->db->get('documents');
        return $query->result();
    }

    function getDocument($id) {
        $this->db->where_in('doc_id', $id);
        $this->db->order_by('doc_id');
        $query = $this->db->get('documents');
        return $query->result();
    }
    function file($id) {
        $this->db->where('folder_id', $id);
        $query = $this->db->get('folders');
        return $query->row();
    }

    function fileDocument($id)
    {
        $this->db->where('doc_id', $id);
        $query = $this->db->get('documents');
        return $query->row();
    }

    function assignedView()
    {
        $this->db->join('folders', 'folders.folder_id = sharefolder_document.sfdoc_sfid');
        $this->db->order_by('sfdoc_id');
        $query = $this->db->get('sharefolder_document');
        return $query->result();
    }

    // Action Condition
    function downloadFile($chacked_id) {
        $sql = "SELECT * FROM folders WHERE folder_id ='".$chacked_id."'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // Insert 
    function insertFolder($data)
    {
        return $this->db->insert('folders', $data);
    }

    function insertDocument($data)
    {
        return $this->db->insert('documents', $data);
    }

    function insertAccount ($data)
    {
        return $this->db->insert('usersaccount', $data);
    }

    function shareFolder($data)
    {
        return $this->db->insert('sharefolder_document', $data);
    }
    //Edit
    function editFolder($id, $data)
    {
        $this->db->where('folder_id', $id);
        return $this->db->update('folders', $data);
    }
    function editDocument($id, $data)
    {
        $this->db->where('doc_id', $id);
        return $this->db->update('documents', $data);
    }
    function editAccount($id, $data)
    {
        $this->db->where('idUsers', $id);
        return $this->db->update('usersaccount', $data);
    }
    //Delete
    function dalateFolder($id)
    {
        return $this->db->delete('folders', array('folder_id' => $id));
    }

    function deleteDocument($id) {
        return $this->db->delete('documents', array('doc_id' => $id));
    }
    
    function deleteAccount($id)
    {
        return $this->db->delete('usersaccount', array('idUsers' => $id));
    }
    function removeDocument($id)
    {
        return $this->db->delete('documents', array('doc_folder' => $id));
    }

}

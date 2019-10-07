<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class Androidapp_model extends CI_Model {

    

    function return_userdetails($userid) {

        $query = $this->db->query("SELECT * FROM users  WHERE user_id = '" . $userid . "' ");
        return $query->result_array();
    }

    function insert_user($data) {
        if ($this->db->insert('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function update_user($id, $data) {
        $this->db->where('user_id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function login($emailusername, $pass) {

        $query = $this->db->query("SELECT * FROM `users` WHERE (`email` = ? OR `username` = ? ) AND `password`= ? AND `role` != 'admin' ", array($emailusername, $emailusername, $pass));

        if ($query->num_rows() > 0) {
            
            return html_escape($query->row_array());
            
        } else {
            return false;
        }
    }

    function email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function username_email_details($emailusername) {

        //check email 
        $this->db->where('email', $emailusername);
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $this->db->where('username', $emailusername);
            $query = $this->db->get("users");
            return $query->result_array();
        }
    }
    
    
    function return_all_servicesdetails() {

        $query = $this->db->query("SELECT * FROM services LEFT JOIN users ON ownerid=user_id  ORDER BY  service_id DESC ");
        return $query->result_array();
    }
    
    function return_filtered_servicesdetails($category) {

        $query = $this->db->query("SELECT * FROM services LEFT JOIN users ON ownerid=user_id WHERE category = '" . $category . "'  ORDER BY  service_id DESC ");
        return $query->result_array();
    }
    
   function return_serviceforuser($userid) {
        $query = $this->db->query(" SELECT * FROM services LEFT JOIN users ON ownerid=user_id WHERE user_id = '" . $userid . "' ORDER BY  service_id DESC  ");
        return $query->result_array();
    }
    
    function return_servicedata($serviceId){
        $query = $this->db->query(" SELECT * FROM services WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    function return_serviceoffers($serviceId){
        $query = $this->db->query(" SELECT * FROM offers WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    function return_serviceRating($serviceId){
        $query = $this->db->query(" SELECT  ROUND (AVG(score),1)as avgscore, COUNT(*) as totalcount FROM ratings WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    
    
}

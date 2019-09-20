<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class UserData_model extends CI_Model {

    function return_all_ownersdetails() {

        $query = $this->db->query("SELECT * FROM users WHERE `role` = 'owner' ORDER BY  user_id DESC ");
        return $query->result_array();
    }

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

    function admin_login($emailusername, $pass) {

        $query = $this->db->query("SELECT * FROM `users` WHERE (`email` = ? OR `username` = ? ) AND `password`= ? AND `role` = 'admin' ", array($emailusername, $emailusername, $pass));

        if ($query->num_rows() > 0) {
            
            $userdetails = $query->result_array();

            //setting session variables for the admin
            $newdata = array(
                'msf_admin' => $userdetails[0]['username'],
                'msf_admin_id' => $userdetails[0]['user_id'],
                'role' => $userdetails[0]['role']
            );
            $this->session->set_userdata($newdata);
            
            if ($userdetails[0]['profile_image'] == "") {
                $this->session->set_userdata('adn_user_img', "placeholder/profile-placeholder.jpg");
            } else {
                $this->session->set_userdata('adn_user_img', $userdetails[0]['profile_image']);
            }

            return true;
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

}

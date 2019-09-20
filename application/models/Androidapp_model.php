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
    
    
    
    function insert_parcel($data) {
        if ($this->db->insert('parcel', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function update_parcel($id, $data) {
        $this->db->where('parcel_id', $id);
        if ($this->db->update('parcel', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function parcel_exists($parcelid) {
        $this->db->where('parcel_id', $parcelid);
        $query = $this->db->get("parcel");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function returnParcelDetails($parcelid) {
        $query = $this->db->query("SELECT * FROM parcel WHERE parcel_id = '".$parcelid."' ");
        return $query->result_array();
                
    }
    function returnLastParcel() {
        
        $query = $this->db->query("SELECT * FROM parcel WHERE parcel_id = (SELECT MAX(parcel_id) FROM parcel )");
        return $query->result_array();
        
    }
    
    
    function sendSMS($phone, $messagetext) {
        // send text message
        try {
        //###########################################################################################       
        //converting phone number to a required format.
            $s = $phone . ' ';
            $matches = array();
            $t = preg_match('/7(.*?) /s', $s, $matches);
            if (array_key_exists('1',$matches)) {

                $phoneno = "+2547" . $matches[1];
                require_once(dirname($_SERVER['SCRIPT_FILENAME']).'/assets/AfricasTalking/AfricasTalkingGateway.php');

                // Specify your login credentials
                $username = "brianmubix";
                $apikey = "cfb978591b9ce5a376818b6fe61711ae3c089c23d172669469c3c304dd1cec42"; //brian
                //$username   = "benn";
                // $apikey     = "0e27d214ec3e44211c4fc1063b1b85c101bf17edb358558d309ae2f97406bb2c";
                // Specify the numbers that you want to send to in a comma-separated list
                // Please ensure you include the country code (+254 for Kenya in this case)
                $recipients = $phoneno;

                // And of course we want our recipients to know what we really do.
                $message = $messagetext;

                // Create a new instance of our awesome gateway class
                $gateway = new AfricasTalkingGateway($username, $apikey);

                // Thats it, hit send and we'll take care of the rest.
                $results = $gateway->sendMessage($recipients, $message);
                
                
                //echo "<br />---sent";
            }
        //###############################################################################################
        } catch (AfricasTalkingGatewayException $e) {
            //echo "error. " . $e;
        }

        //echo "<br/> " . $messagetext;
    }
    
    

}

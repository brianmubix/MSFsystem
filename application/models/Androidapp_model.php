<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class Androidapp_model extends CI_Model {

    function return_all_customerdetails() {

        $query = $this->db->query("SELECT * FROM users WHERE `role` = 'customer' ORDER BY  user_id DESC ");
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
    
    function return_filtered_servicesdetails($category,$sortorder) {
        
        if($sortorder == "Low Rated"){
            $order = "ASC";
        } else {
            $order = "DESC";
        }

        $query = $this->db->query("SELECT *,"
                . "(SELECT CONCAT(ROUND (IFNULL(AVG(score),0),1), '   (', COUNT(*),')') FROM ratings WHERE ratings.service_id = services.service_id ) AS rating "
                . " FROM services LEFT JOIN users ON ownerid=user_id WHERE category = '" . $category . "' AND servicestatus ='Approved' ORDER BY  rating $order ");
        return $query->result_array();
    }
    
   function return_serviceforuser($userid) {
        $query = $this->db->query(" SELECT *,"
                . "(SELECT CONCAT(ROUND (IFNULL(AVG(score),0),1), '   (', COUNT(*),')') FROM ratings WHERE ratings.service_id = services.service_id ) AS rating "
                . " FROM services LEFT JOIN users ON ownerid=user_id WHERE user_id = '" . $userid . "' AND servicestatus ='Approved' ORDER BY  service_id DESC  ");
        return $query->result_array();
    }
    
    function return_servicedata($serviceId){
        $query = $this->db->query(" SELECT * FROM services WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    function insert_offer($data) {
        if ($this->db->insert('offers', $data)) {
            return true;
        } else {
            return false;
        }
    }
    function return_serviceoffers($serviceId){
        $query = $this->db->query(" SELECT * FROM offers WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    function return_serviceRating($serviceId){
        $query = $this->db->query(" SELECT  ROUND (AVG(score),1)as avgscore, COUNT(*) as totalcount FROM ratings WHERE service_id = '".$serviceId."' ");
        return $query->result_array();
    }
    
    function return_serviceRatingData($serviceId){
        $query = $this->db->query(" SELECT *, DATE_FORMAT(`datetime`, '%D %b %Y  %l:%i %p') AS formatteddate FROM ratings "
                . "INNER JOIN services ON ratings.service_id = services.service_id INNER JOIN users ON ratings.userid = users.user_id "
                . "WHERE ratings.service_id = '".$serviceId."' ORDER BY rating_id DESC ");
        return $query->result_array();
    }
    
    
    
    function insert_request($data) {
        if ($this->db->insert('request', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function update_request($requestid, $data) {
        $this->db->where('request_id', $requestid);
        if ($this->db->update('request', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function return_customerRequest($customerId){
        $query = $this->db->query(" SELECT *,request.status  AS requeststatus, DATE_FORMAT(create_at, '%D %b %Y, %l:%i %p') AS formatteddate FROM request "
                . "INNER JOIN users ON customerid = user_id INNER JOIN services ON serviceid = service_id WHERE customerid= '".$customerId."' ORDER BY request_id DESC ");
        return $query->result_array();
    }
    
    function return_ownerRequest($ownerId){
        $query = $this->db->query(" SELECT *,request.status  AS requeststatus, DATE_FORMAT(create_at, '%D %b %Y, %l:%i %p') AS formatteddate FROM request "
                . "INNER JOIN users ON customerid = user_id INNER JOIN services ON serviceid = service_id WHERE owner_id= '".$ownerId."' ORDER BY request_id DESC ");
        return $query->result_array();
    }
    
    
    
    function return_requestdetails($requestId){
        $query = $this->db->query(" SELECT *,request.status  AS requeststatus, request.description  AS requestdesciption, DATE_FORMAT(create_at, '%D %b %Y, %l:%i %p') AS formatteddate FROM request "
                . "INNER JOIN users ON customerid = user_id INNER JOIN services ON serviceid = service_id WHERE request_id= '".$requestId."' ORDER BY request_id DESC ");
        return $query->result_array();
    }
    
    
    
    
    function insert_rating($data) {
        if ($this->db->insert('ratings', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function insert_updates($data) {
        if ($this->db->insert('updates', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function return_requestupdatesdetails($requestId){
        $query = $this->db->query("SELECT *, DATE_FORMAT(`datetime`, '%l:%i %p, %D %b %Y') AS formatteddate FROM updates "
                . "INNER JOIN users ON userid = user_id WHERE requestid='".$requestId."' ");
        return $query->result_array();
    }
    
    
    
    
    
}

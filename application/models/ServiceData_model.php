<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class ServiceData_model extends CI_Model {

    function return_all_servicesdetails() {

        $query = $this->db->query("SELECT * FROM services LEFT JOIN users ON ownerid=user_id  ORDER BY  service_id DESC ");
        return $query->result_array();
    }
    
    function return_filtered_servicesdetails($category) {

        $query = $this->db->query("SELECT * FROM services LEFT JOIN users ON ownerid=user_id WHERE category = '" . $category . "'  ORDER BY  service_id DESC ");
        return $query->result_array();
    }

    function return_servicedetails($serviceid) {

        $query = $this->db->query("SELECT * FROM services LEFT JOIN users ON ownerid=user_id  WHERE service_id = '" . $serviceid . "' ");
        return $query->result_array();
    }
    
    function return_serviceforuser($userid) {
        $query = $this->db->query(" SELECT * FROM services LEFT JOIN users ON ownerid=user_id WHERE user_id = '" . $userid . "' ORDER BY  service_id DESC  ");
        return $query->result_array();
    }
    
    function return_cardsdata() {
        $query = $this->db->query("
                SELECT *,
                (SELECT COUNT(*) FROM services WHERE category='Fuel Station') AS 'Fuel Station',
                (SELECT COUNT(*) FROM services WHERE category='Car Wash') AS 'Car Wash',
                (SELECT COUNT(*) FROM services WHERE category='Car Park') AS 'Car Park',
                (SELECT COUNT(*) FROM services WHERE category='Garage Station') AS 'Garage Station',
                (SELECT COUNT(*) FROM services WHERE category='Car Dealer') AS 'Car Dealer',
                (SELECT COUNT(*) FROM services WHERE category='Recovery Station') AS 'Recovery Station'
                 FROM services
                
                 ");
        return $query->result_array();
    }
    
    

    function insert_service($data) {
        if ($this->db->insert('services', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function update_service($id, $data) {
        $this->db->where('service_id', $id);
        if ($this->db->update('services', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function servicename_exists($servicename) {
        $this->db->where('name', $servicename);
        $query = $this->db->get("services");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

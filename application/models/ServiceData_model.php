<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class ServiceData_model extends CI_Model {

    function return_all_servicesdetails() {

        $query = $this->db->query("SELECT * FROM services ORDER BY  service_id DESC ");
        return $query->result_array();
    }

    function return_servicedetails($serviceid) {

        $query = $this->db->query("SELECT * FROM services  WHERE service_id = '" . $serviceid . "' ");
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

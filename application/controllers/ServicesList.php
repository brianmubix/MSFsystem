<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesList extends CI_Controller {

    public function index() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }

        $this->load->model('ServiceData_model');
        $data['servicesDetailsArray'] = $this->ServiceData_model->return_all_servicesdetails();


        $this->load->view('Services/servicelist_view', $data);
    }

}

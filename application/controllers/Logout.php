<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index() {

        //usset sessions
        $this->session->unset_userdata('msf_admin');
        $this->session->unset_userdata('msf_admin_id');

        $this->session->unset_userdata('role');

        header("Location: " . base_url() . "Login");
    }

}

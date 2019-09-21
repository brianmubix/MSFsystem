<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->model('ServiceData_model');
        $data['servicesDetailsArray'] = $this->ServiceData_model->return_all_servicesdetails();
        $data['cardsDataArray'] = $this->ServiceData_model->return_cardsdata();
        
        $this->load->model('UserData_model');
        $data['ownersDetailsArray'] = $this->UserData_model->return_all_ownersdetails();

        
        $this->load->view('Admin/home_view', $data);
    }

    public function View() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->model('UserData_model');
        $data['adminDetailsArray'] = $this->UserData_model->return_userdetails($this->session->userdata('msf_admin_id'));
        
        $this->load->view('Admin/profile_view', $data);
    }
    
    public function Edit() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->model('UserData_model');
        $data['adminDetailsArray'] = $this->UserData_model->return_userdetails($this->session->userdata('msf_admin_id'));
        
        $this->load->view('Admin/profileedit_view', $data);
    }
    
    public function Update() {

        $userid = $this->input->post('id');
        $oldimg = $this->input->post('oldimage');

        $fistname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $username = $this->input->post('username');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        //check if image is selected        
        if ($_FILES['image']['name'] != "") {
            $imgname = $fistname . $lastname . " " . date("YmdHis");
            $picextension = $_FILES['image']['name'];
            $extension = strtolower(substr($picextension, strpos($picextension, '.') + 1));
            move_uploaded_file($_FILES['image']['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . '/assets/images/Users/' . $imgname . '.' . $extension);

            //add img to insert array
            $data1['profile_image'] = $imgname . '.' . $extension;

            $this->load->model("UserData_model");
            if ($this->UserData_model->update_user($userid, $data1)) {

                //update avatar
                $this->session->set_userdata('msf_user_img', $imgname . '.' . $extension);

                //delete old image from server
                if ($oldimg == "") {
                    $oldimg = "none";
                }
                $prevpic = dirname($_SERVER['SCRIPT_FILENAME']) . '/assets/images/Users/' . $oldimg;
                if (file_exists($prevpic)) {
                    unlink($prevpic);
                }
            }
        }

        //array to insert into users 
        $data['firstname'] = $fistname;
        $data['lastname'] = $lastname;
        $data['gender'] = $gender;
        $data['username'] = $username;
        $data['email'] = $email;
        $data['phone'] = $phone;


        $this->load->model("UserData_model");
        if ($this->UserData_model->update_user($userid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Updated Successiful";
            echo json_encode($response);

            //update username session
            $this->session->set_userdata('msf_admin', $username);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to update please try again";
            echo json_encode($response);
            die();
        }
    }
    
    
    
    public function changePassword() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->view('Admin/changepassword_view');
    }
    
    public function updatePass() {
        
        $data['password'] = $this->input->post('pass');
        
        $this->load->model("UserData_model");
        if ($this->UserData_model->update_user($this->session->userdata('msf_admin_id'), $data)) {

            $response['success'] = '1';
            $response['message'] = "Updated Successiful";
            echo json_encode($response);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to update please try again";
            echo json_encode($response);
            die();
        }
        
        
        
    }

}

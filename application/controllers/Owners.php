<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Owners extends CI_Controller {

    public function index() {


        $this->load->model('UserData_model');
        $data['ownerssDetailsArray'] = $this->UserData_model->return_all_ownersdetails();


        $this->load->view('Owners/ownerslist_view', $data);
    }
    
    
    public function deleteuser($id) {
        
        //delete from db
        $this->db->where('user_id', $id);
        $this->db->delete('users');


    }
    
    public function approveuser($userid) {
        
        $data['status'] = "approved";


        $this->load->model("UserData_model");
        if ($this->UserData_model->update_user($userid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Updated Successiful";
            echo json_encode($response);

            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Failed to update please try again";
            echo json_encode($response);
            die();
        }


    }
    
    public function rejectuser($userid) {
        
        $data['status'] = "rejected";


        $this->load->model("UserData_model");
        if ($this->UserData_model->update_user($userid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Updated Successiful";
            echo json_encode($response);

            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Failed to update please try again";
            echo json_encode($response);
            die();
        }


    }
    
    public function Edit($userid) {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->model('UserData_model');
        $data['ownerDetailsArray'] = $this->UserData_model->return_userdetails($userid);
        
        $this->load->view('Owners/owneredit_view', $data);
    }
    
    public function Update() {

        $userid = $this->input->post('id');

        $fistname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $username = $this->input->post('username');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        

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
            $this->session->set_userdata('adn_user', $username);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to update please try again";
            echo json_encode($response);
            die();
        }
    }
    
    public function View($userid) {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }
        
        $this->load->model('UserData_model');
        $data['ownerDetailsArray'] = $this->UserData_model->return_userdetails($userid);
        
        $this->load->view('Owners/ownerview_view', $data);
    }
    
    public function NewOwner() {

        $fistname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $username = $this->input->post('username');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $pass2 = $this->input->post('pass2');
        
        
        $response['success'] = '0';

        //if username is empty
        if (trim($username) == "") {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Username cannot be empty";
            echo json_encode($response);
            die();
        }

        //check if username exists
        $this->load->model("UserData_model");
        if ($this->UserData_model->username_exists($username)) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! That Username is already taken";
            echo json_encode($response);
            die();
        }

        

        //check if phone number is empty
        if (trim($phone) == "") {

            $response['success'] = '0';
            $response['message'] = "Please enter your phone number";
            echo json_encode($response);
            die();
        }

        // SANITIZE : Remove all illegal characters from email 
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        //validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! The Email you entered is invalid";
            echo json_encode($response);
            die();
        }

        //check if email exists
        $this->load->model("UserData_model");
        if ($this->UserData_model->email_exists($email)) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! That Email is already registered";
            echo json_encode($response);
            die();
        }


        //check if pass is empty
        if (trim($pass) == "") {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Password cannot be blank";
            echo json_encode($response);
            die();
        }

        //check if passwords match
        if ($pass !== $pass2) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Your passwords Does not Match";
            echo json_encode($response);
            die();
        }

        //array to insert into users 
        $data['firstname'] = $fistname;
        $data['lastname'] = $lastname;
        $data['gender'] = $gender;
        $data['username'] = $username;
        $data['password'] = $pass;
        $data['email'] = $email;
        $data['phone'] = $phone;

        
        $this->load->model("UserData_model");
        if ($this->UserData_model->insert_user($data)) {

            $response['success'] = '1';
            $response['message'] = "User Saved Successiful";
            echo json_encode($response);


            //send welcome message

            $mailto = $email;
            $subject = "Registration Successiful";
            $messagetitle = "Registration Successiful.";

            $messagebody = ' 
                </p> Hi ' . $username . " , <br/>
                Thanks for joining ".$this->config->item('system_title').".
                Your registration was successiful:<br/>
                
                <br/><u>Login Details</u>
                <br/><b>Username:</b> $username 
                <br/><b>Password:</b> $pass 

                <br/><br/>

                
                If you didn’t make this request, simply ignore this message.
                
                </p>";


            $this->load->model('Email_model');
            if ($this->Email_model->send_email($mailto, $subject, $messagetitle, $messagebody)) {
                
            }

            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to save please try again";
            echo json_encode($response);
            die();
        }
    }

    
    

}

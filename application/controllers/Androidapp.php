<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Androidapp extends CI_Controller {

    public function login() {

        $emailusername = $this->input->post('username');
        $pass = $this->input->post('password');

        //validate
        $this->load->model("Androidapp_model");
        $data = $this->Androidapp_model->login($emailusername, $pass);

        if ($data == false) {
            $response['success'] = "0";
            $response['message'] = "The email and password you entered did not match any record. Please try again.";
            echo json_encode($response);
        } else {
            $response['success'] = "1";
            $response['message'] = $data;
            echo json_encode($response);
        }
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
        $this->load->model("Androidapp_model");
        if ($this->Androidapp_model->username_exists($username)) {

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
        $this->load->model("Androidapp_model");
        if ($this->Androidapp_model->email_exists($email)) {

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

        $this->load->model("Androidapp_model");
        if ($this->Androidapp_model->insert_user($data)) {

            $response['success'] = '1';
            $response['message'] = "User Saved Successiful";
            echo json_encode($response);
            die();


            //send logins to their emails

            $mailto = $email;
            $subject = "Registration Successiful";
            $messagetitle = "Registration Successiful.";

            $messagebody = ' 
                </p> Hi ' . $username . " , <br/>
                Thanks for joining " . $this->config->item('system_title') . ".
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
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to save please try again";
            echo json_encode($response);
            die();
        }
    }

    public function AllServices() {

        $this->load->model("Androidapp_model");
        $allservices = $this->Androidapp_model->return_all_servicesdetails();

        echo json_encode($allservices);
        die();
    }

    public function userServices($userid) {

        $this->load->model("Androidapp_model");
        $userservices = $this->Androidapp_model->return_serviceforuser($userid);

        echo json_encode($userservices);
        die();
    }

    public function categoryServices() {

        $category = $this->input->post('category');

        $this->load->model("Androidapp_model");
        $userservices = $this->Androidapp_model->return_filtered_servicesdetails($category);

        echo json_encode($userservices);
        die();
    }

    public function NewService() {
        $owner = $this->input->post('owner');
        $category = $this->input->post('category');
        $stationname = $this->input->post('stationname');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $location = $this->input->post('location');
        $description = $this->input->post('description');


        //check if service name exists
        $this->load->model("ServiceData_model");
        if ($this->ServiceData_model->servicename_exists($stationname)) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! That Station Name is already taken";
            echo json_encode($response);
            die();
        } else {


            //array to insert into services 
            $data['ownerid'] = $owner;
            $data['name'] = $stationname;
            $data['category'] = $category;
            $data['description'] = $description;
            $data['location'] = $location;
            $data['latitude'] = $latitude;
            $data['longtude'] = $longitude;

            $this->load->model("ServiceData_model");
            if ($this->ServiceData_model->insert_service($data)) {

                $response['success'] = '1';
                $response['message'] = "Saved Successifuly";
                echo json_encode($response);
                die();
            } else {

                $response['success'] = '0';
                $response['message'] = "Sorry!! failed to save please try again";
                echo json_encode($response);
                die();
            }
        }
    }

    public function getServicedata() {
        
        $serviceId = $this->input->post('id');
        
        $this->load->model("Androidapp_model");
        $servicedata = $this->Androidapp_model->return_servicedata($serviceId);
        $serviceOffers = $this->Androidapp_model->return_serviceoffers($serviceId);
        $serviceRating = $this->Androidapp_model->return_serviceRating($serviceId);

        $response['servicedata'] = $servicedata;
        $response['serviceOffers'] = $serviceOffers;
        $response['serviceRating'] = $serviceRating;
        echo json_encode($response);
        die();
    }

}

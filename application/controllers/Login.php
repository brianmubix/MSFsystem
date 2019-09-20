<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		$this->load->view('Login/login_view');
	}
        
        public function verifylogin() {
        
        $emailusername = $this->input->post('emailusername');
        $pass = $this->input->post('pass');

        //validate
        $this->load->model("UserData_model");
        if ($this->UserData_model->admin_login($emailusername, $pass)) {

                $response['success'] = '1';
                $response['message'] = "Login Successiful";
                echo json_encode($response);
                die();
            
        } else {
            $response['success'] = '0';
            $response['message'] = "Wrong username/Email or password.. <br />Please check them and try again";
            echo json_encode($response);
            die();
        }
    }
    
    public function Recover() {
        $this->load->view('Login/recover_view');
    }
    
    public function sendResetMail() {

        $mailuser = $this->input->post('emailusername');

        //check if email exists
        $this->load->model('UserData_model');
        $userdata['details'] = $this->UserData_model->username_email_details($mailuser);

        if (empty($userdata['details'])) {
            $response['success'] = '0';
            $response['message'] = "Sorry!! That Username / Email is not Registered with us";
            echo json_encode($response);
            die();
        }

        $username = $userdata['details'][0]['username'];
        $userid = $userdata['details'][0]['user_id'];
        $mailto = $userdata['details'][0]['email'];
        $subject = "Reset Your  Password";
        $messagetitle = "Reset Your  Password.";

        $messagebody = ' 
                </p> Hi ' . $username . " , <br/>
                We got a request to reset your account password.
                To start the process, please click the following link:<br/><br/>

                <a href ='" . base_url() . "Login/NewPassword?id=" . $userid . "&q=gJHJj456JKNX" . date("Ymdhis") . "'> Reset Your Password</a><br/><br/>

                The URL will expire in 24 hours for security reasons. 
                If you didn’t make this request, simply ignore this message.
            </p>"
                . '<p style = "text-align:center;"> 
                <a href="' . base_url() . 'Login/NewPassword?id=' . $userid . '&q=gJHJj456JKNX' . date("Ymdhis") . '">
                    <button style = "background-color:#0F9D58; color:white; padding: 10px 32px; border: none; border-radius:5px"> Reset Your Password </button> 
                </a>
                </br>
            </p>
                
                    ';



        $this->load->model('Email_model');
        if ($this->Email_model->send_email($mailto, $subject, $messagetitle, $messagebody)) {
            $response['success'] = '1';
            $response['message'] = "Email sent";
            echo json_encode($response);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again";
            echo json_encode($response);
            die();
        }
    }
    
    
    public function NewPassword() {
        $this->load->view('Login/newpassword_view');
    }
    
    public function UpdatePassword() {

        $id = $this->input->post('userid');
        $data['password'] = $this->input->post('pass');


        //update user
        $this->load->model("UserData_model");
        if ($this->UserData_model->update_user($id, $data)) {
            $response['success'] = '1';
            $response['message'] = "Successiful";
            echo json_encode($response);
            die();
        } else {
            $response['success'] = '0';
            $response['message'] = "Sorry!! Failed to update. Please Try Reseting Again";
            echo json_encode($response);
            die();
        }
    }
        
        
        
}

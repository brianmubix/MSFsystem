<?php

/**
 * Description of UserData
 *
 * @author BRIAN
 */
class Email_model extends CI_Model {

    function send_email($mailto, $subject, $messagetitle, $messagebody) {

        $message = '<html><body style = "font-family: "Times New Roman", Georgia, Serif;">';

        $message .= '<div style = "background-color:#F1F1F1; margin:7px; padding:10px;">';
        
        $message .= '<div style = "background-color:white;  margin:auto; max-width:600px; padding:10px;">';
        //header
        $message .= '<center><img src="' . base_url() . 'assets/images/Logos/Logo.png" onerror="this.style.display="none" style="max-width:100%; max-height: 100px; margin-bottom: 30px;"  /></center>';

        $message .= '<h2 style="color:#0F9D58; text-align:center;">' . $messagetitle . '</h2>';

        $message .= '<hr style = "color:#F1F1F1;">';
        //body

        $message .= '<div style = "padding:5px; font-size:15px;">';

        $message .= $messagebody;
        
        $message .= '<br /><br /><br />Thanks <br /><a href="' . base_url() . '" >'.$this->config->item('system_title').'</a> Team ';
        
        $message .= '</div></div>
                <div style="text-align:center;margin:5px;">
                    <small>Please let us know if this message was sent to you in error.<br>
                    This email was intended for ' . $mailto . ', because you signed up for <a href="' . base_url() . '" >'.$this->config->item('system_title').'</a> |
                     support@'.strtolower(str_replace(" ","",$this->config->item('system_title'))).'.com.<small>
                     </div>';
        
        $message .= '</body></html>';


        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host = 'mail.radioactivetutors.com';   // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'support@radioactivetutors.com';                     // SMTP username
            $mail->Password = 'Radio!active3';                               // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('support@radioactivetutors.com', $this->config->item('system_title'));
            $mail->addAddress($mailto);     // Add a recipient
            $mail->addReplyTo('support@radioactivetutors.com', $this->config->item('system_title'));


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'CONTACT ADIM ERROR OCCURED!!';

            $mail->send();
            
            
            return true;
                  
        } catch (Exception $e) {

            return false;
        }
        
        echo json_encode($response);
    }

}

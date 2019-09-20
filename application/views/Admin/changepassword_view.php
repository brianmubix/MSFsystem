<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>


    </head>
    <body class="green accent-5" >

        <div class="container bg-white" >

            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view('templates/adminmainheader'); ?>
                </div>

            </div>


            <div class="row justify-content-md-around" >

                <div class="col-md-12" >

                     <div class="row justify-content-center p-4">

                            
                            <!-- Material form login -->
                            <div class="card">


                                <h3 class="card-header success-color white-text text-center py-4">
                                    <strong>Change Password</strong>
                                </h3>

                                <!--Card content-->
                                <div class="card-body px-lg-5 pt-0">

                                    <!-- Form -->
                                    <form class="text-center" style="color: #757575;" id="newpassdetails" action="#!">
                                        
                                        <p class="text-center m-3">
                                            Please fill the fields below with your new password then save
                                            
                                        </p>

                                        <!-- New Password -->
                                        <div class="md-form">
                                            <input type="password" id="pass" name="pass" class="form-control"  required>
                                            <label for="email">New Password </label>
                                        </div>

                                        <!-- Confirm New Password -->
                                        <div class="md-form">
                                            <input type="password" id="pass2" name="pass2" class="form-control"  required>
                                            <label for="phone">Confirm New Password </label>
                                        </div>


                                        <!-- Error box -->
                                        <div id="error"></div>

                                        <!-- Sign in button -->
                                        <button class="btn btn-success btn-lg btn-rounded m-3" type="submit">Save</button>

                                        
                                    </form>
                                    <!-- Form -->

                                </div>

                            </div>
                            <!-- Material form login -->


                        </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>
        
            <script src="<?= base_url() ?>assets/js/admin.js?v<?= $this->config->item('code_version'); ?>"></script>

    </body>
</html>
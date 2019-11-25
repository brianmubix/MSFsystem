<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>


    </head>
    <body class="green accent-5" >

        <div class="container p-4" >
            <div class="row justify-content-md-around" >

                <div class="col-md-12" >
                    <!--Card-->
                    <div class="card card-cascade wider reverse my-4 " >

                        <!--Card content-->
                        <div class="card-body card-body-cascade wow fadeIn" data-wow-delay="0.2s" >
                            <p class="text-center">
                                <a href="<?= base_url(); ?>" >
                                    <img class="img-fluid border-secondary" style="max-height: 100px; " src="<?= base_url(); ?>assets/images/Logos/Logo.svg" />
                                </a>
                            </p>

                            <br />

                            <div class="row justify-content-md-around">
                                <div class="col-md-6 card p-4">
                                    <!-- Form -->
                                    <form class="text-center" style="color: #757575;" id="logindetails">

                                        <h3 class="text-center green-text"><b>Motor Services Finder</b></h3>

                                        <p class="card-text text-center">
                                            Please enter credentials to login 
                                        </p>

                                        <!-- Email -->
                                        <div class="md-form">
                                            <input type="text" id="emailusername" name="emailusername" class="form-control" required>
                                            <label for="emailusername">Username / E-mail</label>
                                        </div>

                                        <!-- Password -->
                                        <div class="md-form">
                                            <input type="password" id="pass" name="pass" class="form-control" required>
                                            <label for="pass">Password</label>
                                        </div>

                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <!-- Remember me -->
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                                    <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Forgot password -->
                                                <a href="<?= base_url() ?>Login/Recover">Forgot password?</a>
                                            </div>
                                        </div>

                                        <!-- Error box -->
                                        <div id="error"></div>

                                        <!-- Sign in button -->
                                        <button class="btn btn-success btn-rounded my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                                        <hr />
                                        <!-- Social login -->
                                        <p>or sign in with:</p>
                                        <a href="<?= $this->config->item('facebook'); ?>" target="_blank" class="btn-floating btn-fb btn-sm">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="<?= $this->config->item('twitter'); ?>" target="_blank" class="btn-floating btn-tw btn-sm">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="<?= $this->config->item('linkedin'); ?>" target="_blank" class="btn-floating btn-li btn-sm">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>


                                    </form>
                                    <!-- Form -->
                                </div>


                            </div>

                            <p class="text-center m-2">
                                <a href="<?= base_url(); ?>/AndroidApp/msf.apk" >
                                    <img class="img-fluid border-secondary" style="max-height: 100px; " src="<?= base_url(); ?>assets/images/System/appimage.jpg" />
                                </a>
                            </p>


                        </div>
                        <!--/.Card content-->



                    </div>
                    <!--/.Card-->

                </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

        <script src="<?= base_url() ?>assets/js/login.js?v<?= $this->config->item('code_version'); ?>"></script>

    </body>
</html>
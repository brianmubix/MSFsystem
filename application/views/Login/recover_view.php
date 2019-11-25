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
                                    <form class="text-center" style="color: #757575;" id="resetdetails" >
                                        <h3 class="text-center green-text"><b>Motor Services Finder</b></h3>

                                        <p class="m-3">Please enter your username or password to reset</p>

                                        <!-- Email -->
                                        <div class="md-form">
                                            <input type="text" id="emailusername" name="emailusername" class="form-control" required>
                                            <label for="emailusername">Username / E-mail</label>
                                        </div>



                                        <!-- Error box -->
                                        <div id="error"></div>

                                        <!-- Sign in button -->
                                        <button class="btn btn-success btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Reset</button>

                                        <div class="d-flex justify-content-around">

                                            <div>
                                                <!-- Forgot password -->
                                                Remembered Password
                                                <a href="<?= base_url() ?>Login">Login</a>
                                            </div>
                                        </div>
                                        <br />

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
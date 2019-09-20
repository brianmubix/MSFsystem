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


                    <h1 class="text-center text-success "><b>Profile View</b></h1>
                    <div class="container-fluid">
                        <div class="row justify-content-center py-4">

                            <!-- Card -->
                            <div class="card testimonial-card">
                                <?php  foreach ($adminDetailsArray as $key => $value) {} ?>

                                <!-- Background color -->
                                <div class="card-up green lighten-1"></div>

                                <!-- Avatar -->
                                <div class="avatar mx-auto white">
                                    <img src="<?= base_url();?>assets/images/Users/<?= $this->session->userdata('adn_user_img') ?>" class="rounded-circle" alt="avatar">
                                </div>

                                <!-- Content -->
                                <div class="card-body">
                                    <!-- Name -->
                                    <h4 class="card-title"><?= $value['firstname']." ".$value['lastname']; ?></h4>
                                    <hr>
                                    <p>Here is your profile details. You can edit by clicking Edit button</p>
                                    
                                    <table class="table table-striped" style="text-align: left;">
                                        <thead >
                                            <tr><th></th><th></th></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Firstname</b></td><td><?= $value['firstname']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Lastname</b></td><td><?= $value['lastname']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Gender</b></td><td><?= $value['gender']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Username</b></td><td><?= $value['username']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td><td><?= $value['email']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone</b></td><td><?= $value['phone']?></td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                    
                                    <a href="<?= base_url();?>Admin/Edit" class="btn btn-success btn-lg btn-rounded m-3"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    
                                    
                                </div>

                            </div>
                            <!-- Card -->


                        </div>
                </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

    </body>
</html>
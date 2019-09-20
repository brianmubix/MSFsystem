<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>
        
        <link rel="stylesheet" href="<?= base_url() ?>assets/MDB/css/bootstrap-select.css" />


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

                            <?php
                            foreach ($adminDetailsArray as $key => $value) {
                                
                            }
                            ?>

                            <!-- Material form login -->
                            <div class="card">


                                <h3 class="card-header success-color white-text text-center py-4">
                                    <strong>Edit Profile</strong>
                                </h3>

                                <!--Card content-->
                                <div class="card-body px-lg-5 pt-0">

                                    <!-- Form -->
                                    <form class="text-center" style="color: #757575;" id="updatedetails" action="#!">



                                        <p class="text-center m-3">
                                            Please enter update your information then save
                                            <input type="hidden" id="id" name="id" value="<?= $value['user_id'] ?>" />
                                            <input type="hidden" id="oldimage" name="oldimage" value="<?= $value['profile_image'] ?>" />

                                        </p>

                                        <!-- profile image -->
                                        <center><img id="previewing" src="<?= base_url(); ?>assets/images/Users/<?= $this->session->userdata('adn_user_img'); ?>?v<?= $this->config->item('code_version'); ?>" style="max-height: 150px;" class="img-fluid" /></center>
                                        <div id="imgerror"></div>

                                        <!-- Profile -->
                                        <div class="md-form">
                                            <input type="file" id="image" name="image" class="form-control" >
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <!-- First name -->
                                                <div class="md-form">
                                                    <input type="text" id="firstname" name="firstname" class="form-control" value="<?= $value['firstname'] ?>" required>
                                                    <label for="firstname">First name</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <!-- Last name -->
                                                <div class="md-form">
                                                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?= $value['lastname'] ?>" required>
                                                    <label for="lastname">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- gender -->
                                        <div class="md-form mb-5">
                                            <span class="float-left">Gender </span>
                                            <select class="selectpicker colorful-select dropdown-primary form-control"  name="gender" id="gender" required>

                                                <option value="" selected> -- Select Gender --</option>
                                                <option <?php
                                                if ($value['gender'] == "Male") {
                                                    echo 'selected';
                                                }
                                                ?> >Male</option>

                                                <option <?php
                                                if ($value['gender'] == "Female") {
                                                    echo 'selected';
                                                }
                                                ?> >Female</option>

                                            </select>
                                        </div>



                                        <!-- Username -->
                                        <div class="md-form">
                                            <input type="text" id="username" name="username" class="form-control" value="<?= $value['username'] ?>" required>
                                            <label for="username">Username </label>
                                        </div>

                                        <!-- Email -->
                                        <div class="md-form">
                                            <input type="email" id="email" name="email" class="form-control" value="<?= $value['email'] ?>" required>
                                            <label for="email">Email </label>
                                        </div>

                                        <!-- Phone -->
                                        <div class="md-form">
                                            <input type="number" id="phone" name="phone" class="form-control" value="<?= $value['phone'] ?>" required>
                                            <label for="phone">Phone </label>
                                        </div>


                                        


                                        <!-- Error box -->
                                        <div id="error"></div>

                                        <!-- Sign in button -->
                                        <button class="btn btn-success btn-lg btn-rounded m-3" type="submit">Save</button>

                                        
                                    </form>

                                    <hr />
                                    <a href="<?= base_url(); ?>Admin/View" ><i class="fas fa-eye"></i> View Profile</a>


                                    <!-- Form -->

                                </div>

                            </div>
                            <!-- Material form login -->


                        </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>
        
        <script src="<?= base_url() ?>assets/MDB/js/bootstrap.bundle.min.js"></script>
            <script src="<?= base_url() ?>assets/MDB/js/bootstrap-select.min.js"></script>
            <script src="<?= base_url() ?>assets/js/admin.js?v<?= $this->config->item('code_version'); ?>"></script>

    </body>
</html>
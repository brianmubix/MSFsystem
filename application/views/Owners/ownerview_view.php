<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>

        <style>
            .row-striped:nth-of-type(odd){
                background-color: #efefef;
                border-left: 4px #000000 solid;
            }

            .row-striped:nth-of-type(even){
                background-color: #ffffff;
                border-left: 4px #efefef solid;
            }

            .row-striped {
                padding: 15px 0 0 0;
            }
        </style>


    </head>
    <body class="green accent-5" >

        <div class="container bg-white" >

            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view('templates/adminmainheader'); ?>
                </div>

            </div>


            <h1 class="text-center text-success "><b>Owner Profile </b></h1>
            <div class="row justify-content-md-around" >

                <div class="col-md-6" >

                    <div class="container-fluid">
                        <div class="row justify-content-center py-4">

                            <!-- Card -->
                            <div class="card testimonial-card">
                                <?php
                                foreach ($ownerDetailsArray as $key => $value) {
                                    
                                }

                                if ($value['status'] == "pending") {
                                    $status = '<p class="text-primary"><b>Pending </b>'
                                            . '<button class="btn btn-sm btn-success btn-rounded" onclick="approveuser(' . $value['user_id'] . ')" ><i class="fa fa-check"></i> Approve</button>'
                                            . '<button class="btn btn-sm btn-danger btn-rounded" onclick="rejectuser(' . $value['user_id'] . ')" ><i class="fa fa-times"></i> Reject</button></p>';
                                } else if ($value['status'] == "rejected") {
                                    $status = '<p class="text-danger"><b>Rejected </b>'
                                            . '<button class="btn btn-sm btn-success btn-rounded" onclick="approveuser(' . $value['user_id'] . ')" ><i class="fa fa-check"></i> Approve</button></p>';
                                } else {
                                    $status = '<p class="text-success"><b>Approved</b></p>';
                                }
                                ?>

                                <!-- Background color -->
                                <div class="card-up success-color lighten-1"></div>

                                <!-- Avatar -->
                                <div class="avatar mx-auto white">
                                    <img src="<?= base_url(); ?>assets/images/Users/placeholder/profile-placeholder.jpg" class="rounded-circle" alt="avatar">
                                </div>

                                <!-- Content -->
                                <div class="card-body">
                                    <!-- Name -->
                                    <h4 class="card-title"><?= $value['firstname'] . " " . $value['lastname']; ?></h4>
                                    <hr>
                                    <p>Here is your profile details. You can edit by clicking Edit button</p>

                                    <table class="table table-striped" style="text-align: left;">
                                        <thead >
                                            <tr><th></th><th></th></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Firstname</b></td><td><?= $value['firstname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Lastname</b></td><td><?= $value['lastname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Gender</b></td><td><?= $value['gender'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Username</b></td><td><?= $value['username'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td><td><?= $value['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone</b></td><td><?= $value['phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Status</b></td><td><?= $status; ?></td>
                                            </tr>
                                            


                                        </tbody>
                                    </table>

                                    <a href="<?= base_url(); ?>Owners/Edit/<?= $value['user_id'] ?>" class="btn btn-success btn-lg btn-rounded m-3"><i class="fas fa-edit"></i> Edit</a>



                                </div>

                            </div>
                            <!-- Card -->


                        </div>
                    </div>

                </div>

                <div class="col-md-6 p-4" >
                    <p class="text-center text-success m-3"><b>Stations under this account </b></p>

                    <?php
                    $count = 0;
                    foreach ($servicesDetailsArray as $key => $value) {
                        $count++;


                        if ($value['category'] == "Fuel Station") {
                            $icon = '<i class="fas fa-gas-pump"></i>';
                            $color = 'default';
                        } else if ($value['category'] == "Car Wash") {
                            $icon = '<i class="fas fa-car"></i>';
                            $color = 'primary';
                        } else if ($value['category'] == "Car Park") {
                            $icon = '<i class="fas fa-parking"></i>';
                            $color = 'success';
                        } else if ($value['category'] == "Garage Station") {
                            $icon = '<i class="fas fa-tools"></i>';
                            $color = 'warning';
                        } else if ($value['category'] == "Car Dealer") {
                            $icon = '<i class="fas fa-car-side"></i>';
                            $color = 'secondary';
                        } else if ($value['category'] == "Recovery Station") {
                            $icon = '<i class="fas fa-truck-loading"></i>';
                            $color = 'danger';
                        }
                        ?>


                        <div class="row row-striped py-2">
                            <div class="col-2 bg-<?= $color; ?>">

                                <h1 class="text-white text-center mt-3 mb-0" > <?= $icon; ?> </h1>
                                <p class="text-center text-white mt-0"><b><?= $value['category']; ?></b></p>
                            </div>
                            <div class="col-10">
                                <h5 class="text-uppercase"><strong><?= $value['name']; ?></strong></h5>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fas fa-list-ul"></i> Category: <?= $value['category']; ?></li>
                                    <li class="list-inline-item"><i class="fas fa-map-marked-alt" ></i> <?= $value['location']; ?></li>
                                </ul>
                                <a href="<?= base_url(); ?>ServicesList/View/<?= $value['service_id']; ?>" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                <a href="<?= base_url(); ?>ServicesList/Edit/<?= $value['service_id']; ?>" class="btn btn-sm btn-info btn-rounded" ><i class="fa fa-edit"></i> Edit</a>

                            </div>
                        </div>


                        <?php
                    }

                    if ($count == 0) {
                        echo '<div class="row row-striped py-2"> <div class="col-10"><p class="text-center"> <b> No Station under this account </b> </p></div> </div>';
                    }
                    ?>



                </div>


            </div>


            <!-- Default SCRIPTS -->
            <?php $this->load->view('templates/defaultfooterlinks'); ?>
            
            <script src="<?= base_url() ?>assets/js/owners.js?v<?= $this->config->item('code_version'); ?>"></script>


    </body>
</html>
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


            <div class="row justify-content-md-around" >

                <div class="col-md-12" >

                    <!--Title-->
                    <h3 class="text-center green-text"><b>Motor Services Finder Admin Portal</b></h3>
                    <?php
                    foreach ($cardsDataArray as $key => $card) {
                        
                    }
                    ?>

                    <div class="row justify-content-center">

                        <div class=" col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList" >
                                <div class="card card-default border-default zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-default d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-gas-pump"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Fueling Stations</p>
                                                <h4 class="card-title"><?= $card['Fuel Station']; ?></h4>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList?list=fuel" >
                                <div class="card card-primary border-primary zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-primary d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-car"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Car Wash </p>
                                                <h4 class="card-title"><?= $card['Car Wash']; ?></h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList?list=parking" >
                                <div class="card card-success border-success zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-success d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-parking"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Car Parking </p>
                                                <h4 class="card-title"><?= $card['Car Park']; ?></h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class=" col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList?list=garage" >
                                <div class="card card-warning border-warning zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-warning d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-tools"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Garage Stations</p>
                                                <h4 class="card-title"><?= $card['Garage Station']; ?></h4>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class=" col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList?list=dealer" >
                                <div class="card card-secondary border-secondary zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-secondary d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-car-side"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Car Dealers</p>
                                                <h4 class="card-title"><?= $card['Car Dealer']; ?></h4>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-md-3 m-3">
                            <a href="<?= base_url(); ?>ServicesList?list=recovery" >
                                <div class="card card-danger border-danger zoom">
                                    <div class="container-fluid">
                                        <div class="row flex-items-xs-middle">
                                            <div class="col-4 bg-danger d-flex justify-content-center p-4" >

                                                <h1 class="text-white text-center " > <i class="fas fa-truck-loading"></i> </h1>

                                            </div>
                                            <div class="col-8 justify-content-center">
                                                <p class="card-text">Recovery Station </p>
                                                <h4 class="card-title"><?= $card['Recovery Station']; ?></h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>


                    <hr />

                    <div class="row justify-content-center">

                        <div class=" col-md-6 p-4">

                            <h4 class="text-center green-text">Recently Registered Stations</h4>

                            <?php
                            $count = 0;
                            foreach ($servicesDetailsArray as $key => $value) {
                                $count++;

                                if ($count < 4) {

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


                                    <div class="row row-striped py-0 my-2">
                                        <div class="col-2 bg-<?= $color; ?>">

                                            <h1 class="text-white text-center mt-3 mb-0" > <?= $icon; ?> </h1>
                                            <p class="text-center text-white mt-0"><b><?= $value['category']; ?></b></p>
                                        </div>
                                        <div class="col-10">
                                            <h5 class="text-uppercase"><strong><?= $value['name']; ?></strong></h5>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item"><i class="fas fa-list-ul"></i> Category: <?= $value['category']; ?></li>
                                                <li class="list-inline-item"><i class="fas fa-map-marked-alt" ></i> <?= $value['location']; ?></li>
                                            </ul>                                            
                                            Status: <?= $value['servicestatus']; ?><br />
                                            <a href="<?= base_url(); ?>ServicesList/View/<?= $value['service_id']; ?>" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                            <a href="<?= base_url(); ?>ServicesList/Edit/<?= $value['service_id']; ?>" class="btn btn-sm btn-info btn-rounded" ><i class="fa fa-edit"></i> Edit</a>

                                        </div>
                                    </div>


                                    <?php
                                }
                            }
                            ?>

                            <p class="text-center">
                                <a href="<?= base_url(); ?>ServicesList" class="btn btn-sm btn-success btn-lg btn-rounded m-3">View More <i class="fas fa-arrow-right"></i></a>
                            </p>

                        </div>

                        <div class=" col-md-5 p-4">

                            <h4 class="text-center green-text">Recently Registered Owners</h4>
                            <?php
                            $count = 0;
                            foreach ($ownersDetailsArray as $key => $value1) {
                                $count++;
                                if ($count < 4) {
                                if($value1['status'] == "pending"){
                                    $status = '<i class="text-primary fas fa-sync-alt"></i> Pending';
                                    
                                }else if($value1['status'] == "rejected"){
                                    $status = '<i class="text-danger fa fa-times"></i> Rejected';
                                } else {
                                    $status = '<i class=" text-success fa fa-check"></i> Approved';
                                }
                                ?>
                                <div class="row row-striped py-2">
                                    
                                    <div class="col-12">
                                        <h5 class="text-uppercase"><strong><?= $value1['firstname']." ".$value1['lastname']; ?></strong></h5>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><?= $status; ?></li>
                                            <li class="list-inline-item"><i class="fas fa-envelope"></i> <?= $value1['email']; ?></li>
                                            <li class="list-inline-item"><i class="fas fa-phone" ></i> <?= $value1['phone']; ?></li>
                                        </ul>
                                        <a href="<?= base_url(); ?>Owners/View/<?= $value1['user_id']; ?>" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                        <a href="<?= base_url(); ?>Owners/Edit/<?= $value1['user_id']; ?>" class="btn btn-sm btn-info btn-rounded" ><i class="fa fa-edit"></i> Edit</a>

                                    </div>
                                </div>
                            
                                <?php }} ?>
                            
                            <p class="text-center">
                                <a href="<?= base_url(); ?>Owners" class="btn btn-sm btn-success btn-lg btn-rounded m-3">View More <i class="fas fa-arrow-right"></i></a>
                            </p>


                        </div>



                    </div>


                </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

    </body>
</html>
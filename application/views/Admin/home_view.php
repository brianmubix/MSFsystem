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

                    <!--Title-->
                    <h3 class="text-center green-text"><b>Motor Services Finder Admin Portal</b></h3>

                    <div class="row justify-content-center">

                        <div class=" col-md-3 m-3">
                            <div class="card card-default border-default zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-default d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-gas-pump"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Fueling Station</p>
                                            <h4 class="card-title">5</h4>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class=" col-md-3 m-3">
                            <div class="card card-info border-success zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-success d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-tools"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Garage Station</p>
                                            <h4 class="card-title">7</h4>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class=" col-md-3 m-3">
                            <div class="card card-secondary border-secondary zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-secondary d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-truck-loading"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Recovery Station</p>
                                            <h4 class="card-title">5</h4>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 m-3">
                            <div class="card card-primary border-primary zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-primary d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-car"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Car Wash </p>
                                            <h4 class="card-title">3</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 m-3">
                            <div class="card card-primary border-primary zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-primary d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-parking"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Car Parking </p>
                                            <h4 class="card-title">3</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-3 m-3">
                            <div class="card card-primary border-primary zoom">
                                <div class="container-fluid">
                                    <div class="row flex-items-xs-middle">
                                        <div class="col-md-4 bg-primary d-flex justify-content-center p-4" >

                                            <h1 class="text-white text-center " > <i class="fas fa-truck-loading"></i> </h1>
                                            
                                        </div>
                                        <div class="col-md-8 justify-content-center">
                                            <p class="card-text">Recovery Station </p>
                                            <h4 class="card-title">3</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                    

                </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

    </body>
</html>
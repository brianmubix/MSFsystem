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
                    
                            
                            <br />
                            <!--Title-->
                            <h3 class="text-center green-text"><b>Added Stations</b></h3>

                            <p class="card-text text-center">
                                Available Stations 
                            </p>
                            
                            <div class="row ">
                                
                                list appears here
                                
                            </div>

                </div>

            </div>


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

    </body>
</html>
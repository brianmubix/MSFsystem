<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>

        
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 300px;

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


                    <h1 class="text-center text-success mb-0"><b>Service View</b></h1>
                    <div class="container-fluid">
                        <div class="row justify-content-center py-4">

                            <!-- Card -->
                            <div class="card testimonial-card">
                                <?php  foreach ($serviceDetailsArray as $key => $value) {} 
                                
                                if($value['category'] == "Fuel Station"){
                                    $icon = '<i class="fas fa-gas-pump"></i>';
                                    $color ='default';
                                    
                                }else if($value['category'] == "Car Wash"){
                                    $icon = '<i class="fas fa-car"></i>';
                                    $color ='primary';
                                    
                                }else if($value['category'] == "Car Park"){
                                    $icon = '<i class="fas fa-parking"></i>';
                                    $color ='success';
                                    
                                }else if($value['category'] == "Garage Station"){
                                    $icon = '<i class="fas fa-tools"></i>';
                                    $color ='warning';
                                    
                                }else if($value['category'] == "Car Dealer"){
                                    $icon = '<i class="fas fa-car-side"></i>';
                                    $color ='secondary';
                                    
                                }else if($value['category'] == "Recovery Station"){
                                    $icon = '<i class="fas fa-truck-loading"></i>';
                                    $color ='danger';
                                    
                                }
                                
                                ?>

                                
                                <!-- Background color -->
                                <div class="card-up success-color lighten-1"></div>

                                <!-- Avatar -->
                                <div class="avatar mx-auto white bg-<?=$color; ?> ">
                                    <h1 class="text-white text-center my-4" > <?=$icon; ?> </h1>
                                </div>

                                <!-- Content -->
                                <div class="card-body">
                                    <!-- Name -->
                                    <h4 class="card-title text-uppercase"><?= $value['name']; ?></h4>
                                    <hr>
                                    <p>Here is service details. You can edit by clicking Edit button</p>
                                    
                                    <table class="table table-striped" style="text-align: left;">
                                        <thead >
                                            <tr><th></th><th></th></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Owner</b></td>
                                                <td>
                                                    <b>Names: </b><?= $value['firstname']." ".$value['lastname']; ?>
                                                    <br /><b>Email: </b><?= $value['email']?>
                                                    <br /><b>Phone: </b><?= $value['phone']?>
                                                    <br /><a href="<?= base_url() ?>Owners/View/<?= $value['user_id']; ?>">View more... <i class="fas fa-arrow-right"></i> </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Category</b></td><td><?= $value['category']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Description</b></td><td><?= $value['description']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Verification Doc</b></td>
                                                <td>
                                                            <?php
                                                            if($value['license'] == ""){
                                                                echo "None Submited";
                                                            } else {
                                                                echo '<img class="img-fluid" style="max-width:200px;" src="'. base_url().'assets/images/licenses/'.$value['license'].'" />';
                                                            }
                                                            ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Status</b></td>
                                                <td>
                                                    <?= $value['servicestatus']?><br/>
                                                    <button class="btn btn-sm btn-success btn-rounded " onclick="approveservice(<?= $value['service_id'];?>)" ><i class="fa fa-check"></i> Approve </button>
                                                    <button class="btn btn-sm btn-danger btn-rounded " onclick="rejectservice(<?= $value['service_id'];?>)" ><i class="fa fa-times"></i> Reject </button>
                                                </td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <b>Map Location</b>
                                    <div id="map"></div>
                                    
                                    <a href="<?= base_url(); ?>ServicesList/Edit/<?= $value['service_id'];?>" class="btn btn-success btn-lg btn-rounded m-3"><i class="fas fa-edit"></i> Edit</a>
                                    
                                </div>

                            </div>
                            <!-- Card -->


                        </div>
                </div>

            </div>


        </div>
            <hr />


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

        <script>
            function initMap() {
                var lat = "<?= $value['latitude'];?>";
                var long = "<?= $value['longtude'];?>";

                var myLatlng = new google.maps.LatLng(lat, long);
                var mapOptions = {
                    zoom: 6,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                // Place a draggable marker on the map
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: '<?= base_url() ?>assets/images/System/marker.png',
                    map: map,
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    title: "<?= $value['name'];?>"
                });

                google.maps.event.addListener(marker, 'dragend', function (marker) {
                    var latLng = marker.latLng;
                    currentLatitude = latLng.lat();
                    currentLongitude = latLng.lng();
                    $("#latitude").val(currentLatitude);
                    $("#longitude").val(currentLongitude);
                });


            }


        </script>


        <script src="<?= base_url() ?>assets/js/markerclusterer.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvuspZieDAMlpAVAe2qwlvkk8oQU34dtg&amp;callback=initMap"></script>


        <script src="<?= base_url() ?>assets/js/services.js?v<?= $this->config->item('code_version'); ?>"></script>

        


    </body>
</html>
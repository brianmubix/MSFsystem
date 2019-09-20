<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('system_title'); ?></title>

        <?php $this->load->view('templates/defaultheaderlinks'); ?>

        <!-- MDBootstrap Datatables  -->
        <link href="<?= base_url() ?>assets/MDB/css/addons/datatables.min.css" rel="stylesheet">


        <link rel="stylesheet" href="<?= base_url() ?>assets/MDB/css/bootstrap-select.css" />

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
        
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 400px;

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


            <div class="row justify-content-center">

                
                <div class=" col-md-12 text-center ">
                    <h3 class="text-center green-text"><b>Registered Service Stations</b></h3>

                    <button class="btn btn-sm btn-outline-success btn-rounded" data-toggle="modal" data-target="#newServiceModal"> Add New</button>

                    <div class="row justify-content-md-center">
                        <div class="btn-group text-center" style="overflow-x: auto;">
                            <button type="button" class="btn blue-gradient btn-sm" onclick="requestslist('All')" ><i class="fa fa-list-ol"></i> All</button>
                            <button type="button" class="btn btn-default btn-sm" onclick="requestslist('Pending')"><i class="fas fa-gas-pump"></i> Fuel</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="requestslist('Accepted')"><i class="fas fa-car"></i> Car Wash</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="requestslist('All')" ><i class="fas fa-parking"></i> Parking</button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="requestslist('Pending')"><i class="fas fa-tools"></i> Garage</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="requestslist('Accepted')"><i class="fas fa-car-side"></i> Dealer</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="requestslist('Rejected')"><i class="fas  fa-truck-loading"></i> Recovery</button>
                        </div>
                    </div>
                    
                    <p class="text-center mt-3"><b id="filterlabel">Showing All</b></p>
                    
                </div>
                
                <div class=" col-md-7 ">
                    <?php
                    foreach ($servicesDetailsArray as $key => $value) {
                        ?>

                        <div class="row row-striped ">
                            <div class="col-2 bg-default">
                                <h4 class="text-center"><br /></h4>
                                <h1 class="text-white text-center " > <i class="fas fa-gas-pump"></i> </h1>
                            </div>
                            <div class="col-10">
                                <h5 class="text-uppercase"><strong><?= $value['name']; ?></strong></h5>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fas fa-list-ul"></i> Category: <?= $value['category']; ?></li>
                                    <li class="list-inline-item"><i class="fas fa-map-marked-alt" ></i> <?= $value['location']; ?></li>
                                </ul>
                                <a href="#" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                <a href="#" class="btn btn-sm btn-info btn-rounded "  ><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-danger btn-rounded float-right" onclick="deleteevent()" ><i class="fa fa-trash"></i> Delete</buttonu>

                            </div>
                        </div>


                    <?php } ?>

                </div>

            </div>
            <hr />


        </div>

        <!--New Service Modal -->
        <div class="modal fade" id="newServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Service Station </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <!-- Form -->
                        <form class="text-center" style="color: #757575;" id="newmemberdetails" action="#!">

                            <!-- Station Owner -->
                            <div class="md-form mb-5">
                                <span class="float-left">Station Owner </span>
                                <select class="selectpicker colorful-select dropdown-success form-control"  name="owner" id="owner" data-live-search="true" required>

                                    <option value="" selected> -- Select Station Owner --</option>
                                    <option>Fuel</option>
                                    <option>Car wash</option>

                                </select>
                            </div>

                            <!-- category -->
                            <div class="md-form mb-5">
                                <span class="float-left">Category </span>
                                <select class="selectpicker colorful-select dropdown-success form-control"  name="category" id="category" required>

                                    <option value="" selected> -- Select Category --</option>
                                    <option>Fuel</option>
                                    <option>Car wash</option>

                                </select>
                            </div>

                            <!-- Station Name -->
                            <div class="md-form">
                                <input type="text" id="stationname" name="stationname" class="form-control" required>
                                <label for="stationname">Station Name </label>
                            </div>
                            
                            <!-- Phone -->
                            <div class="md-form">
                                <input type="text" id="phone" name="phone" class="form-control" required>
                                <label for="phone">Location </label>
                            </div>

                            
                            <!-- Select Loaction -->
                            <div class="md-form">
                                <h4>Drag marker to your Chemist location<br/>
                                    <small><i>(Zoom in For accuracy)</i></small></h4>
                                
                                <div id="map"></div>


                            </div>
                            
                            <div class="form-row">
                                <div class="col">
                                    <!-- Latitude -->
                                    <div class="md-form">
                                        <input type="text" class="form-control" name="latitude" id="latitude" value="-0.3976933438904146" readonly  required />
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Longitude -->
                                    <div class="md-form">
                                        <input type="text" class="form-control " name="longitude" id="longitude" value="36.960871638024855" readonly required />
                                    </div>
                                </div>
                            </div>

                            



                            <!-- Error box -->
                            <div id="error"></div>

                            <!-- Sign in button -->
                            <button class="btn btn-success btn-lg btn-rounded " type="submit">Save</button>

                        </form>
                        <!-- Form -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!--END New Service Modal -->


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

        <!-- MDBootstrap Datatables  -->
        <script type="text/javascript" src="<?= base_url() ?>assets/MDB/js/addons/datatables.min.js"></script>

        <script src="<?= base_url() ?>assets/MDB/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/MDB/js/bootstrap-select.min.js"></script>
        
        <script>
            function initMap() {
                var lat = "-0.3976933438904146";
                var long = "36.960871638024855";

                function getLocation() {
                    if (navigator.geolocation) {
                        //is success
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        //if failed

                    }
                }

                function showPosition(position) {
                    lat = position.coords.latitude;
                    long = position.coords.longitude;

                }

                getLocation();


                var myLatlng = new google.maps.LatLng(lat, long);
                var mapOptions = {
                    zoom: 6,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                // Place a draggable marker on the map
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    //icon: '<?= base_url() ?>assets/images/System/marker.png',
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    title: "Drag me!"
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

        <script>
                                $(document).ready(function () {
                                    $('#dtMembers').DataTable();
                                });

        </script>

    </body>
</html>
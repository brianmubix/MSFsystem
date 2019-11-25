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
                            <button type="button" class="btn blue-gradient btn-sm" onclick="filterservice('All')" ><i class="fa fa-list-ol"></i> All</button>
                            <button type="button" class="btn btn-default btn-sm" onclick="filterservice('Fuel Station')"><i class="fas fa-gas-pump"></i> Fuel</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="filterservice('Car Wash')"><i class="fas fa-car"></i> Car Wash</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="filterservice('Car Park')" ><i class="fas fa-parking"></i> Parking</button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="filterservice('Garage Station')"><i class="fas fa-tools"></i> Garage</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="filterservice('Car Dealer')"><i class="fas fa-car-side"></i> Dealer</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="filterservice('Recovery Station')"><i class="fas  fa-truck-loading"></i> Recovery</button>
                        </div>
                    </div>

                    <p class="text-center mt-3"></p>

                </div>

                <div class=" col-md-7 ">
                    <table class="table table-sm table-borderless" id="dtServices">
                        <thead>
                            <tr>
                                <th>#</th><th align="center"><b id="filterlabel">Showing All</b></th>
                            </tr>
                        </thead>
                        <tbody id="servicelist" >
                            <?php
                            $count = 0;
                            foreach ($servicesDetailsArray as $key => $value) {
                                $count++;
                                
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
                            
                                <tr>
                                    <td><?= $count ?></td> 
                                    <td>

                                        <div class="row row-striped py-0 ">
                                            <div class="col-2 bg-<?=$color; ?>">
                                                
                                                <h1 class="text-white text-center mt-3 mb-0" > <?=$icon; ?> </h1>
                                                <p class="text-center text-white mt-0"><b><?= $value['category']; ?></b></p>
                                            </div>
                                            <div class="col-10">
                                                <h5 class="text-uppercase"><strong><?= $value['name']; ?></strong></h5>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="fas fa-list-ul"></i> Category: <?= $value['category']; ?></li>
                                                    <li class="list-inline-item"><i class="fas fa-map-marked-alt" ></i> <?= $value['location']; ?></li>
                                                </ul> 
                                                <hr class="mb-0" />
                                                <b>Status: <?= $value['servicestatus']; ?></b>
                                                <hr class="mt-0" />
                                                <a href="<?= base_url();?>ServicesList/View/<?= $value['service_id'];?>" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                                <a href="<?= base_url();?>ServicesList/Edit/<?= $value['service_id'];?>" class="btn btn-sm btn-info btn-rounded" ><i class="fa fa-edit"></i> Edit</a>
                                                <button class="btn btn-sm btn-danger btn-rounded float-right" onclick="deleteservice(<?= $value['service_id'];?>)" ><i class="fa fa-trash"></i> Delete</button>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            <?php } ?>
                        </tbody>
                    </table>

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
                        <form class="text-center" style="color: #757575;" id="newservicedetails" action="#!">

                            <!-- Station Owner -->
                            <div class="md-form mb-5">
                                <span class="float-left">Station Owner </span>
                                <select class="selectpicker colorful-select dropdown-success form-control"  name="owner" id="owner" data-live-search="true" required>

                                    <option value="" selected> -- Select Station Owner --</option>
                                    <?php
                                    foreach ($ownersDetailsArray as $key => $value1) {
                                        echo '<option value="' . $value1['user_id'] . '" >' . $value1['firstname'] . ' ' . $value1['lastname'] . '</option>';
                                    }
                                    ?>


                                </select>
                            </div>

                            <!-- category -->
                            <div class="md-form mb-5">
                                <span class="float-left">Category </span>
                                <select class="selectpicker colorful-select dropdown-success form-control"  name="category" id="category" required>

                                    <option value="" selected> -- Select Category --</option>
                                    <option>Fuel Station</option>
                                    <option>Car Wash</option>
                                    <option>Car Park</option>
                                    <option>Garage Station</option>
                                    <option>Car Dealer</option>
                                    <option>Recovery Station</option>

                                </select>
                            </div>

                            <!-- Station Name -->
                            <div class="md-form">
                                <input type="text" id="stationname" name="stationname" class="form-control" required>
                                <label for="stationname">Station Name </label>
                            </div>


                            <!-- Select Loaction -->
                            <div class="md-form">
                                <h4>Drag marker to your Station location<br/>
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


                            <!-- Location Name -->
                            <div class="md-form">
                                <input type="text" id="location" name="location" class="form-control" required>
                                <label for="location">Location Name </label>
                            </div>

                            <!-- Description  -->
                            <div class="md-form">
                                <textarea id="description" name="description" class="form-control md-textarea" required></textarea>
                                <label for="description">Description </label>
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
                                                        icon: '<?= base_url() ?>assets/images/System/marker.png',
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
                $('#dtServices').DataTable();
            });

        </script>


    </body>
</html>
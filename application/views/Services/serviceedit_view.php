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


            <div class="row justify-content-md-around" >

                <div class="col-md-12" >

                    <div class="row justify-content-center p-4">

                        <?php
                        foreach ($serviceDetailsArray as $key => $value) {
                            
                        }
                        ?>

                        <!-- Material form login -->
                        <div class="card">


                            <h3 class="card-header success-color white-text text-center py-4">
                                <strong>Edit Service Statation</strong>
                            </h3>

                            <!--Card content-->
                            <div class="card-body px-lg-5 pt-0">
                                
                                Here is service details. You can edit then click save button

                                <!-- Form -->
                                <form class="text-center" style="color: #757575;" id="updateservicedetails" action="#!">
                                    
                                    <input type="hidden" id="id" name="id" value="<?= $value['service_id'];?>" />

                                    <!-- Station Owner -->
                                    <div class="md-form mb-5">
                                        <span class="float-left">Station Owner </span>
                                        <select class="selectpicker colorful-select dropdown-success form-control"  name="owner" id="owner" data-live-search="true" required>

                                            <?php
                                            foreach ($ownersDetailsArray as $key => $value1) {
                                                echo '<option value="' . $value1['user_id'] . '" >' . $value1['firstname'] . ' ' . $value1['lastname'] . '</option>';
                                            }
                                            echo '<option select value="' . $value['user_id'] . '" >' . $value['firstname'] . ' ' . $value['lastname'] . '</option>';
                                            ?>

                                        </select>
                                    </div>

                                    <!-- category -->
                                    <div class="md-form mb-5">
                                        <span class="float-left">Category </span>
                                        <select class="selectpicker colorful-select dropdown-success form-control"  name="category" id="category" required>

                                            <option <?php if ($value['category'] == "Fuel Station") {  echo 'selected';} ?>>Fuel Station</option>
                                            <option <?php if ($value['category'] == "Car Wash") {  echo 'selected';} ?>>Car Wash</option>
                                            <option <?php if ($value['category'] == "Car Park") {  echo 'selected';} ?>>Car Park</option>
                                            <option <?php if ($value['category'] == "Garage Station") {  echo 'selected';} ?>>Garage Station</option>
                                            <option <?php if ($value['category'] == "Car Dealer") {  echo 'selected';} ?>>Car Dealer</option>
                                            <option <?php if ($value['category'] == "Recovery Station") {  echo 'selected';} ?>>Recovery Station</option>

                                        </select>
                                    </div>

                                    <!-- Station Name -->
                                    <div class="md-form">
                                        <input type="text" id="stationname" name="stationname" class="form-control" value="<?= $value['name'];?>" required>
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
                                                <input type="text" class="form-control" name="latitude" id="latitude" value="<?= $value['latitude'];?>" readonly  required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <!-- Longitude -->
                                            <div class="md-form">
                                                <input type="text" class="form-control " name="longitude" id="longitude" value="<?= $value['longtude'];?>" readonly required />
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Location Name -->
                                    <div class="md-form">
                                        <input type="text" id="location" name="location" class="form-control" value="<?= $value['location'];?>" required>
                                        <label for="location">Location Name </label>
                                    </div>

                                    <!-- Description  -->
                                    <div class="md-form">
                                        <textarea id="description" name="description" class="form-control md-textarea" required><?= $value['description'];?></textarea>
                                        <label for="description">Description </label>
                                    </div>



                                    <!-- Error box -->
                                    <div id="error"></div>

                                    <!-- Sign in button -->
                                    <button class="btn btn-success btn-lg btn-rounded " type="submit">Save</button>

                                </form>
                                <!-- Form -->

                                <hr />
                                <a href="<?= base_url();?>ServicesList/View/<?= $value['service_id'];?>" ><i class="fas fa-eye"></i> View</a>


                                <!-- Form -->

                            </div>

                        </div>
                        <!-- Material form login -->


                    </div>

                </div>


            </div>
            <hr />


        </div>


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>

        <!-- MDBootstrap Datatables  -->
        <script type="text/javascript" src="<?= base_url() ?>assets/MDB/js/addons/datatables.min.js"></script>

        <script src="<?= base_url() ?>assets/MDB/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/MDB/js/bootstrap-select.min.js"></script>

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
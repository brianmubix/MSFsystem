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


    </head>
    <body class="green accent-5" >

        <div class="container bg-white" >
            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view('templates/adminmainheader'); ?>

                </div>

            </div>

            <div class="row" >
                <div class="col-md-12">

                    <h2 class="text-center text-success m-3"><b>Registered Service Owners</b></h2>

                </div>
            </div>

            <div class="row justify-content-center">

                <div class=" col-md-12 table-responsive">
                    
                    <button class="btn  btn-outline-success btn-rounded" data-toggle="modal" data-target="#newMemberModal"> Add New</button>

                    
                    <table class="table table-hover table-bordered table-striped" id="dtMembers">
                        <thead>
                            <tr>
                                <th>#</th><th>Names</th><th>Username</th><th>Gender</th><th>Contacts</th><th>Status</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=0;
                            foreach ($ownersDetailsArray as $key => $value) {
                                $count++;
                                
                                if($value['status'] == "pending"){
                                    $status = '<p class="text-primary"><b>Pending </b></p>'
                                            . '<button class="btn btn-sm btn-success btn-rounded" onclick="approveuser(' . $value['user_id'] . ')" ><i class="fa fa-check"></i> Approve</button>'
                                            . '<button class="btn btn-sm btn-danger btn-rounded" onclick="rejectuser(' . $value['user_id'] . ')" ><i class="fa fa-times"></i> Reject</button>';
                                }else if($value['status'] == "rejected"){
                                    $status = '<p class="text-danger"><b>Rejected </b></p>'
                                            . '<button class="btn btn-sm btn-success btn-rounded" onclick="approveuser(' . $value['user_id'] . ')" ><i class="fa fa-check"></i> Approve</button>';
                                } else {
                                    $status = '<p class="text-success"><b>Approved</b></p>';
                                }
                                echo ' 
                                    <tr>
                                        <td>'.$count.'</td> 
                                        <td>'.$value['firstname'].' '.$value['lastname'].'</td> 
                                        <td>'.$value['username'].'</td> 
                                        <td>'.$value['gender'].'</td>
                                        <td>
                                        Email: '.$value['email'].'
                                        <br/>Phone: '.$value['phone'].'
                                        </td>
                                        <td>'.$status.'</td>
                                        <td>
                                        <a href="' . base_url() . 'Owners/View/' . $value['user_id'] . '" class="btn btn-sm  btn-success btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                                        <a href="' . base_url() . 'Owners/Edit/' . $value['user_id'] . '" class="btn btn-sm btn-info btn-rounded "  ><i class="fa fa-edit"></i> Edit</a>
                                        <button class="btn btn-sm btn-danger btn-rounded float-right" onclick="deleteuser(' . $value['user_id'] . ')" ><i class="fa fa-trash"></i> Delete</button>

                                        </td>
                                    </tr>
                                    ';
                                
                            }?>
                        </tbody>
                    </table>

                </div>




            </div>
            <hr />



        </div>
        
        <!--New Member Modal -->
            <div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Owner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" id="newmemberdetails" action="#!">



                                <div class="form-row">
                                    <div class="col">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input type="text" id="firstname" name="firstname" class="form-control"  required>
                                            <label for="firstname">First name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Last name -->
                                        <div class="md-form">
                                            <input type="text" id="lastname" name="lastname" class="form-control" required>
                                            <label for="lastname">Last name</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- gender -->
                                <div class="md-form mb-5">
                                    <span class="float-left">Gender </span>
                                    <select class="selectpicker colorful-select dropdown-success form-control"  name="gender" id="gender" required>

                                        <option value="" selected> -- Select Gender --</option>
                                        <option>Male</option>
                                        <option>Female</option>

                                    </select>
                                </div>

                                <!-- Username -->
                                <div class="md-form">
                                    <input type="text" id="username" name="username" class="form-control" required>
                                    <label for="username">Username </label>
                                </div>

                                <!-- Email -->
                                <div class="md-form">
                                    <input type="email" id="email" name="email" class="form-control" required>
                                    <label for="email">Email </label>
                                </div>

                                <!-- Phone -->
                                <div class="md-form">
                                    <input type="number" id="phone" name="phone" class="form-control" required>
                                    <label for="phone">Phone </label>
                                </div>


                                <!-- Password -->
                                <div class="md-form">
                                    <input type="password" id="pass" name="pass" class="form-control" required>
                                    <label for="pass">Password </label>
                                </div>

                                <!-- Confirm Password -->
                                <div class="md-form">
                                    <input type="password" id="pass2" name="pass2" class="form-control" required>
                                    <label for="pass2">Confirm Password </label>
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
            <!--END New Member Modal -->


        <!-- Default SCRIPTS -->
        <?php $this->load->view('templates/defaultfooterlinks'); ?>
        <!-- MDBootstrap Datatables  -->
        <script type="text/javascript" src="<?= base_url() ?>assets/MDB/js/addons/datatables.min.js"></script>

        <script src="<?= base_url() ?>assets/MDB/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/MDB/js/bootstrap-select.min.js"></script>

        <script src="<?= base_url() ?>assets/js/owners.js?v<?= $this->config->item('code_version'); ?>"></script>

        <script>
            $(document).ready(function () {
                $('#dtMembers').DataTable();
            });

        </script>

    </body>
</html>
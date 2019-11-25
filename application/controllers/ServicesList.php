<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesList extends CI_Controller {

    public function index() {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }

        $this->load->model('ServiceData_model');
        $data['servicesDetailsArray'] = $this->ServiceData_model->return_all_servicesdetails();

        $this->load->model('UserData_model');
        $data['ownersDetailsArray'] = $this->UserData_model->return_all_ownersdetails();



        $this->load->view('Services/servicelist_view', $data);
    }

    public function filteredServices() {
        $category = $this->input->post('category');

        $this->load->model('ServiceData_model');
        $data['servicesDetailsArray'] = $this->ServiceData_model->return_filtered_servicesdetails($category);

        if ($category == "All") {
            $data['servicesDetailsArray'] = $this->ServiceData_model->return_all_servicesdetails();
        }

        $count = 0;
        foreach ($data['servicesDetailsArray'] as $key => $value) {
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

            <tr>
                <td><?= $count ?></td> 
                <td>

                    <div class="row row-striped pt-0">
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
                            <hr class="mb-0" />
                            <b>Status: <?= $value['servicestatus']; ?></b>
                            <hr class="mt-0" />
                            <a href="<?= base_url(); ?>ServicesList/View/<?= $value['service_id']; ?>" class="btn btn-sm btn-default btn-rounded "  ><i class="fa fa-eye"></i> View</a>
                            <a href="<?= base_url(); ?>ServicesList/Edit/<?= $value['service_id']; ?>" class="btn btn-sm btn-info btn-rounded" ><i class="fa fa-edit"></i> Edit</a>
                            <button class="btn btn-sm btn-danger btn-rounded float-right" onclick="deleteservice(<?= $value['service_id']; ?>)" ><i class="fa fa-trash"></i> Delete</buttonu>

                        </div>
                    </div>
                </td>
            </tr>


            <?php
        }

        if ($count == 0) {
            echo '<tr><td></td><td>No Results Found</td></tr>';
        }
    }

    public function NewService() {
        $owner = $this->input->post('owner');
        $category = $this->input->post('category');
        $stationname = $this->input->post('stationname');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $location = $this->input->post('location');
        $description = $this->input->post('description');


        //check if service name exists
        $this->load->model("ServiceData_model");
        if ($this->ServiceData_model->servicename_exists($stationname)) {

            $response['success'] = '0';
            $response['message'] = "Sorry!! That Station Name is already taken";
            echo json_encode($response);
            die();
        } else {


            //array to insert into services 
            $data['ownerid'] = $owner;
            $data['name'] = $stationname;
            $data['category'] = $category;
            $data['description'] = $description;
            $data['location'] = $location;
            $data['latitude'] = $latitude;
            $data['longtude'] = $longitude;

            $this->load->model("ServiceData_model");
            if ($this->ServiceData_model->insert_service($data)) {

                $response['success'] = '1';
                $response['message'] = "Saved Successifuly";
                echo json_encode($response);
                die();
            } else {

                $response['success'] = '0';
                $response['message'] = "Sorry!! failed to save please try again";
                echo json_encode($response);
                die();
            }
        }
    }

    public function deleteservice($id) {

        //delete from db
        $this->db->where('service_id', $id);
        $this->db->delete('services');
    }
    
    public function approveservice($serviceid) {

        $data['servicestatus'] = "Approved";

        $this->load->model("ServiceData_model");
        if ($this->ServiceData_model->update_service($serviceid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Approved Successifully";
            echo json_encode($response);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Failed. please try again";
            echo json_encode($response);
            die();
        }
        
    }
    public function rejectservice($serviceid) {

        $data['servicestatus'] = "Rejected";

        $this->load->model("ServiceData_model");
        if ($this->ServiceData_model->update_service($serviceid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Approved Successifully";
            echo json_encode($response);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! Failed. please try again";
            echo json_encode($response);
            die();
        }
        
    }
    
    
    
    

    public function Edit($serviceid) {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }

        $this->load->model('ServiceData_model');
        $data['serviceDetailsArray'] = $this->ServiceData_model->return_servicedetails($serviceid);

        $this->load->model('UserData_model');
        $data['ownersDetailsArray'] = $this->UserData_model->return_all_ownersdetails();

        $this->load->view('Services/serviceedit_view', $data);
    }

    public function updateService() {

        $serviceid = $this->input->post('id');

        $owner = $this->input->post('owner');
        $category = $this->input->post('category');
        $stationname = $this->input->post('stationname');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $location = $this->input->post('location');
        $description = $this->input->post('description');

        //array to update service
        $data['ownerid'] = $owner;
        $data['name'] = $stationname;
        $data['category'] = $category;
        $data['description'] = $description;
        $data['location'] = $location;
        $data['latitude'] = $latitude;
        $data['longtude'] = $longitude;

        $this->load->model("ServiceData_model");
        if ($this->ServiceData_model->update_service($serviceid, $data)) {

            $response['success'] = '1';
            $response['message'] = "Updated Successiful";
            echo json_encode($response);
            die();
        } else {

            $response['success'] = '0';
            $response['message'] = "Sorry!! failed to update please try again";
            echo json_encode($response);
            die();
        }
    }

    public function View($serviceid) {
        if (!isset($_SESSION['msf_admin_id'])) {
            header("Location: " . base_url() . "Login");
        }

        $this->load->model('ServiceData_model');
        $data['serviceDetailsArray'] = $this->ServiceData_model->return_servicedetails($serviceid);


        $this->load->view('Services/serviceview_view', $data);
    }

}

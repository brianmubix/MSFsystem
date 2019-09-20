<!--Navbar -->
<nav class="mb-1 navbar navbar-light navbar-expand-lg">
    <a class="navbar-brand" href="<?= base_url(); ?>Admin"> <img class="img-fluid border-primary" style="max-height: 50px;" src="<?= base_url(); ?>assets/images/Logos/Logo.png" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
            aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav mr-auto" id="navbarNav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>Admin">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>ServicesList">Services</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>Owners">Owners</a>
            </li>
            
            


        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">            
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url(); ?>assets/images/Users/<?= $this->session->userdata('adn_user_img'); ?>?v<?= $this->config->item('code_version'); ?>" class="rounded-circle z-depth-0"
                         alt="avatar">
                    <b class="ml-2"><?= $this->session->userdata('msf_admin'); ?></b>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-success"
                     aria-labelledby="navbarDropdownMenuLink-55">
                    
                    <a class="dropdown-item" href="<?= base_url(); ?>Admin/View">My Profile</a>
                    <a class="dropdown-item" href="<?= base_url(); ?>Admin/Edit">Edit Profile</a>
                    <a class="dropdown-item" href="<?= base_url(); ?>Admin/changePassword">Change Password</a>
                    <a class="dropdown-item" href="<?= base_url(); ?>Logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--/.Navbar -->

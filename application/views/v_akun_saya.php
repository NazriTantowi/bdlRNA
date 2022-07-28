<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url()?>template/dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $this->session->userdata('nama_pelanggan') ?></h3>

                            <p class="text-muted text-center">Customer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>E-mail</b> <a class="float-right"><?= $this->session->userdata('email') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Customer ID</b> <a class="float-right"><?= $this->session->userdata('id_pelanggan') ?></a>
                                </li>
                            </ul>

                            <a href="<?= base_url()?>" class="btn btn-primary btn-block"><b>Back to Home</b></a>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
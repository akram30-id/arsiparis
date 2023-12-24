<section class="section" style="margin-bottom: 164px;">

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
        } ?>

            <?php if ($this->session->flashdata('fail')) { ?>
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('fail'); ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
        } ?>
        </div>
    </div>

    <div class="container" id="content">
        <div class="row justify-content-center">
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('box#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA BOX</h5>
                            <?php if ($data['last_box'] == null) { ?>
                                Data Box is Empty
                                <?php 
                            } else { ?>
                            <small><i><b>Last Update : <?= date('d F Y', strtotime($data['last_box']->created_at)) ?></b></i></small>
                            <br>
                            <small>Box Code: <?= $data['last_box']->box_code ?></small>
                            <?php 
                        } ?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('shelf#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA RAK</h5>
                            <?php if ($data['last_shelf'] == null) { ?>
                                Data Rak is Empty
                                <?php 
                            } else { ?>
                            <small><i><b>Last Update : <?= date('d F Y', strtotime($data['last_shelf']->created_at)) ?></b></i></small>
                            <br>
                            <small>Rak Name: <?= $data['last_shelf']->shelf_name ?></small>
                            <?php 
                        } ?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('room#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA ROOM</h5>
                            <?php if ($data['last_room'] == null) { ?>
                                Data Room is Empty
                                <?php 
                            } else { ?>
                            <small><i><b>Last Update : <?= date('d F Y', strtotime($data['last_room']->created_at)) ?></b></i></small>
                            <br>
                            <small>Room Name: <?= $data['last_room']->room_name ?></small>
                            <?php 
                        } ?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('unit#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA UNIT KERJA</h5>
                            <?php if ($data['last_unit'] == null) { ?>
                                Data Unit Kerja is Empty
                                <?php 
                            } else { ?>
                            <small><i><b>Last Update : <?= date('d F Y', strtotime($data['last_unit']->created_at)) ?></b></i></small>
                            <br>
                            <small>Unit Name: <?= $data['last_unit']->unit_name ?></small>
                            <?php 
                        } ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
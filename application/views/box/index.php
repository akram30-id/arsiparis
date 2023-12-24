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
            <div class="card" id="content" style="font-size: 10pt;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0">Data Box</h2>
                    <a href="<?= base_url('box/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah Box</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Box</th>
                                <th>Kode Rak</th>
                                <th>Kapasitas</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Update</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($boxes as $box) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $box->box_code ?></td>
                                <td><?= $box->shelf_code ?></td>
                                <td><?= $box->capacity ?></td>
                                <td><?= $box->description ?></td>
                                <td><?= $box->status ?></td>
                                <td><?= date('d F Y', strtotime($box->created_at)) . ' by ' . $box->added_by ?></td>
                                <td><?= $box->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($box->updated_at)) . ' by ' . $box->updated_by ?></td>
                                <td>
                                <!-- delete vendor trigger modal -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deleteBox<?= $box->box_id ?>">
                                            Hapus
                                        </button>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <!-- <div style="min-height: 120px;"> -->
                                            <div class="collapse collapse-horizontal" id="deleteBox<?= $box->box_id ?>">
                                                <div class="card card-body" style="width: 300px;">
                                                Yakin Ingin Menghapus Box <?= $box->box_code ?>?
                                                <div class="d-flex justify-content-end">
                                                    <a style="color: red; margin-right: 8px;" href="<?= base_url('box/delete/' . $box->box_id) ?>">Ya</a>
                                                    <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deleteBox<?= $box->box_id ?>" href="#">Tidak</a>
                                                </div>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                    <!-- update vendor trigger modal -->
                                    <a href="<?= base_url("box/edit/$box->box_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal">
                                        Update
                                    </a>
                                </td>
                            </tr>

                            <?php 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
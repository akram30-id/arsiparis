<section class="section" style="margin-bottom: 164px;">

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>

            <?php if ($this->session->flashdata('fail')) { ?>
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('fail'); ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
            <div class="card" id="content" style="font-size: 10pt;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0">Data Gedung</h2>
                    <a href="<?= base_url('building/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah Gedung</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Gedung</th>
                                <th>Nama Gedung</th>
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
                            foreach ($buildings as $building) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $building->building_code ?></td>
                                <td><?= $building->building_name ?></td>
                                <td><?= $building->description ?></td>
                                <td><?= $building->status ?></td>
                                <td><?= date('d F Y', strtotime($building->created_at)) . ' by ' . $building->added_by ?></td>
                                <td><?= $building->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($building->updated_at)) . ' by ' . $building->updated_by ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- delete building trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deletebuilding<?= $building->building_id ?>" aria-expanded="false" aria-controls="deletebuilding<?= $building->building_id ?>">
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-8 my-1">
                                            <!-- <div style="min-height: 120px;"> -->
                                                <div class="collapse collapse-horizontal" id="deletebuilding<?= $building->building_id ?>">
                                                    <div class="card card-body" style="width: 300px;">
                                                    Yakin Ingin Menghapus Gedung/Gudang <?= $building->building_name ?>?
                                                    <div class="d-flex justify-content-end">
                                                        <a style="color: red; margin-right: 8px;" href="<?= base_url('building/delete/' . $building->building_id) ?>">Ya</a>
                                                        <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deletebuilding<?= $building->building_id ?>" href="#">Tidak</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <!-- update building trigger modal -->
                                    <a href="<?= base_url("building/edit/$building->building_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal mb-1">
                                        Update
                                    </a>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
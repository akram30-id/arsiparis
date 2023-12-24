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
                    <h2 class="mt-3 mb-3 text-center border-0">Data Rak Existing</h2>
                    <a href="<?= base_url('shelf/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah Rak</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Ruangan</th>
                                <th>Kode Rak</th>
                                <th>Nama Rak</th>
                                <th>Kategori Rak</th>
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
                            foreach ($shelfs as $shelf) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $shelf->room_code ?></td>
                                <td><?= $shelf->shelf_code ?></td>
                                <td><?= $shelf->shelf_name ?></td>
                                <td><?= $shelf->category_name ?></td>
                                <td><?= $shelf->description ?></td>
                                <td><?= $shelf->status ?></td>
                                <td><?= date('d F Y', strtotime($shelf->created_at)) . ' by ' . $shelf->added_by ?></td>
                                <td><?= $shelf->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($shelf->updated_at)) . ' by ' . $shelf->updated_by ?></td>
                                <td>
                                    <!-- delete shelf trigger modal -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- delete shelf trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deleteShelf<?= $shelf->shelf_id ?>" aria-expanded="false" aria-controls="deleteShelf<?= $shelf->shelf_id ?>">
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-8 my-1">
                                            <!-- <div style="min-height: 120px;"> -->
                                                <div class="collapse collapse-horizontal" id="deleteShelf<?= $shelf->shelf_id ?>">
                                                    <div class="card card-body" style="width: 300px;">
                                                    Yakin Ingin Menghapus shelf <?= $shelf->shelf_name ?>?
                                                    <div class="d-flex justify-content-end">
                                                        <a style="color: red; margin-right: 8px;" href="<?= base_url('shelf/delete/' . $shelf->shelf_id) ?>">Ya</a>
                                                        <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deleteShelf<?= $shelf->shelf_id ?>" href="#">Tidak</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <!-- update shelf trigger modal -->
                                    <a href="<?= base_url("shelf/edit/$shelf->shelf_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal mb-1">
                                        Update
                                    </a>

                                    <!-- direct to detail shelf -->
                                    <a href="<?= base_url("shelf/shelf_detail/$shelf->shelf_code#content") ?>" class="btn btn-secondary btn-sm rounded-pill">
                                        Detail
                                    </a>
                                </td>
                            </tr>


                            <!-- DELETE vendor Modal -->
                            <div class="modal fade" id="deleteShelf<?= $shelf->shelf_id ?>" aria-labelledby="deleteShelfLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between">
                                                <h3>Ingin Menghapus Rak <?= $shelf->shelf_name ?>?</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="d-flex justify-content-end mt-5">
                                                <a href="#" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" style="margin-right: 8px;">Tidak</a>
                                                <a href="<?= base_url('shelf/delete/' . $shelf->shelf_id) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
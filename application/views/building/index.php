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
                                    <!-- delete vendor trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill mb-1 btn-modal" data-bs-toggle="modal" data-bs-target="#deleteGudang<?= $building->building_id ?>">
                                        Hapus
                                    </button>

                                    <!-- update vendor trigger modal -->
                                    <a href="<?= base_url("building/edit/$building->building_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal">
                                        Update
                                    </a>
                                </td>
                            </tr>


                            <!-- DELETE vendor Modal -->
                            <div class="modal fade" id="deleteGudang<?= $building->building_id ?>" aria-labelledby="deleteGudangLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="fw-bold">Hapus Gudang <?= $building->building_name ?>?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="d-flex justify-content-end mt-5">
                                                <a href="#" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" style="margin-right: 8px;">Tidak</a>
                                                <a href="<?= base_url('building/delete/' . $building->building_id) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- UPDATE vendor Modal -->
                            <div class="modal fade" id="updateGudang<?= $building->building_id ?>" tabindex="-1" aria-labelledby="updateGudangLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="fw-bold">Update Gedung</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="<?= base_url('building/update/' . $building->building_id) ?>" method="POST" class="needs-validation" novalidate>

                                                <div class="row justify-content-center mt-3">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="nama-vendor" class="form-label">NAMA GEDUNG</label>
                                                        <input type="text" class="form-control" id="nama-gedung" name="nama-gedung" value="<?= $building->building_name ?>" required>
                                                        <div class="invalid-feedback">
                                                            Nama gudang Wajib Diisi
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for="kode-vendor" class="form-label">KODE GEDUNG</label>
                                                        <input type="text" class="form-control" id="kode-gedung" name="kode-gedung" value="<?= $building->building_code ?>" disabled>
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for="kode-vendor" class="form-label">DESKRIPSI</label>
                                                        <input type="text" class="form-control" id="deskripsi-gedung" name="deskripsi-gedung" value="<?= $building->description ?>" required>
                                                        <div class="invalid-feedback">
                                                            Deskripsi Gedung Wajib Diisi
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for="status-gedung" class="form-label">STATUS</label>
                                                        <?php $status = ['ACTIVE', 'INACTIVE'] ?>
                                                        <select class="form-select" name="status-gedung" id="status-gedung">
                                                            <?php foreach ($status as $s) { ?>
                                                            <option value="<?= $s ?>" <?php if ($s == $building->status) echo "selected='selected'" ?>><?= $s ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Status gedung wajib dipilih.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end mt-5">
                                                    <a href="#" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" style="margin-right: 8px;">Batal</a>
                                                    <input type="submit" value="Update" class="btn btn-warning btn-sm">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
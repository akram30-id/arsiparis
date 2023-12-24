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
                    <h2 class="mt-3 mb-3 text-center border-0">Data Unit Kerja</h2>
                    <a href="<?= base_url('unit/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah Unit Kerja</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Unit</th>
                                <th>Nama Unit</th>
                                <th>Deskripsi</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Update</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($units as $unit) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $unit->unit_code ?></td>
                                <td><?= $unit->unit_name ?></td>
                                <td><?= $unit->description ?></td>
                                <td><?= date('d F Y', strtotime($unit->created_at)) . ' by ' . $unit->added_by ?></td>
                                <td><?= $unit->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($unit->updated_at)) . ' by ' . $unit->updated_by ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- delete unit trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deleteUnit<?= $unit->unit_id ?>" aria-expanded="false" aria-controls="deleteUnit<?= $unit->unit_id ?>">
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-8 my-1">
                                            <!-- <div style="min-height: 120px;"> -->
                                                <div class="collapse collapse-horizontal" id="deleteUnit<?= $unit->unit_id ?>">
                                                    <div class="card card-body" style="width: 300px;">
                                                    Yakin Ingin Menghapus Unit <?= $unit->unit_name ?>?
                                                    <div class="d-flex justify-content-end">
                                                        <a style="color: red; margin-right: 8px;" href="<?= base_url('unit/delete/' . $unit->unit_id) ?>">Ya</a>
                                                        <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deleteUnit<?= $unit->unit_id ?>" href="#">Tidak</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <!-- update unit trigger modal -->
                                    <a href="<?= base_url("unit/edit/$unit->unit_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal mb-1">
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
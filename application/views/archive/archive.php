<section style="margin-bottom: 164px;">

    <div class="row justify-content-center mt-5" id="card-content">
        <div class="col-md-10" id="data">
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
            <div class="card fw-semibold" id="content" style="font-size: 8pt; color: #000;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0"><?= $title ?> <a href="<?= base_url('archive/archive_sync#content') ?>" class="mb-3 text-warning rounded-pill"><i class="bi bi-arrow-repeat"></i></a></h2>
                    <a href="<?= base_url('archive/archive_new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah archive</a>
                    <a href="<?= base_url('archive/archive_show_disposed#content') ?>" class="btn btn-danger btn-sm mb-3 rounded-pill">Data Disposal</a>
                    <a href="<?= base_url('archive/archive_report#content') ?>" target="_blank" class="btn btn-success btn-sm mb-3 rounded-pill">Cetak Laporan Arsip</a>
                    <table class="table table-hover table-bordered datatable display">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Arsip</th>
                                <th>Judul Arsip</th>
                                <th>Kode Box</th>
                                <th>Nama Rak</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Tipe Retensi</th>
                                <th>Tanggal Retensi</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Terakhir Update</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($archives as $archive) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                <a class="text-danger fw-bold show-qr" target="_blank" href="<?= base_url('archive/archive_label_show/' . $archive->archive_code) ?>">
                                    <?= $archive->archive_code ?>
                                </a>
                                    <?= ($archive->box_code == null && $archive->shelf_code == null) ? '<span>(DIGITALIZED)</span>' : '' ?>
                                </td>
                                <td><?= $archive->archive_title ?></td>
                                <td><?= in_array($archive->box_code, ["", null]) ? "NOT STORED IN ANY BOX" : $archive->box_code ?></td>
                                <td><?= in_array($archive->shelf_code, ["", null]) ? "NOT STORED IN ANY SHELF" : $archive->shelf_name ?></td>
                                <td><?= $archive->unit_code == null ? 'ALL UNITS' : $archive->unit_name ?></td>
                                <td><?= $archive->archive_status ?></td>
                                <td class="text-primary"><?= $archive->archive_status == 'PERMANEN' ? '#PERMANENT' : $archive->retention_type ?></td>
                                <td class="text-danger"><?= $archive->archive_status == 'PERMANEN' ? '#PERMANENT' : date('d F Y', strtotime($archive->retention_date)) ?></td>
                                <td><?= $archive->description ?></td>
                                <td><?= date('d F Y', strtotime($archive->created_at)) . ' by ' . $archive->added_by ?></td>
                                <td><?= $archive->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($archive->updated_at)) . ' by ' . $archive->updated_by ?></td>
                                <td>
                                <!-- dispose archive trigger modal -->
                                <div class="row">
                                    <div class="col-md-10 mb-1">
                                        <!-- update archive -->
                                        <a href="<?= base_url("archive/archive_edit/$archive->archive_id#content") ?>" class="btn btn-warning btn-sm rounded-pill">
                                            Update
                                        </a>
                                    </div>
                                    <div class="col-md-10 mb-1">
                                        <!-- assign document to archive -->
                                        <a href="<?= base_url("archive/archive_assign/$archive->archive_code#content") ?>" class="btn btn-success btn-sm rounded-pill">
                                            Assign
                                        </a>
                                    </div>
                                    <div class="col-md-10 mb-1">
                                        <!-- show detail archive -->
                                        <a href="<?= base_url("archive/archive_detail/$archive->archive_code#content") ?>" class="btn btn-secondary btn-sm rounded-pill">
                                            Detail
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#disposearchive<?= $archive->archive_id ?>">
                                            Dispose
                                        </button>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <!-- <div style="min-height: 120px;"> -->
                                            <div class="collapse collapse-horizontal" id="disposearchive<?= $archive->archive_id ?>">
                                                <div class="card card-body" style="width: 300px;">
                                                Yakin Ingin Dispose <?= $archive->archive_title ?>?
                                                <div class="d-flex justify-content-end">
                                                    <a style="color: red; margin-right: 8px;" href="<?= base_url('archive/archive_dispose/' . $archive->archive_code) ?>">Ya</a>
                                                    <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#disposearchive<?= $archive->archive_id ?>" href="#">Tidak</a>
                                                </div>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
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
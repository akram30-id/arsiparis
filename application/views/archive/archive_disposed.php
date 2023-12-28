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
            <div class="card fw-semibold" id="content" style="color: #000; border: 1px solid red;">
                <div class="card-body">
                    <h2 class="mt-3 mb-5 text-center text-danger border-0"><?= $title ?></h2>
                    <a href="<?= base_url('archive/archive#content') ?>" class="btn btn-secondary btn-sm mb-3 rounded-pill">Kembali Ke Arsip Aktif</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Arsip</th>
                                <th>Judul Arsip</th>
                                <th>Unit</th>
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
                                <td><?= $archive->archive_code ?> <?= ($archive->box_code == null && $archive->shelf_code == null) ? '<span>(DIGITALIZED)</span>' : '' ?></td>
                                <td><?= $archive->archive_title ?></td>
                                <td><?= $archive->unit_code == null ? 'ALL UNITS' : $archive->unit_name ?></td>
                                <td><?= $archive->description ?></td>
                                <td><?= date('d F Y', strtotime($archive->dispose_date)) . ' by ' . $archive->disposed_by ?></td>
                                <td><?= $archive->dispose_update_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($archive->dispose_update_at)) . ' by ' . $archive->dispose_updated_by ?></td>
                                <td>
                                <!-- dispose archive trigger modal -->
                                <div class="row">
                                    <div class="col-md-10 mb-1">
                                        <!-- assign document to archive -->
                                        <a href="<?= base_url("archive/archive_restore/$archive->archive_code#content") ?>" class="btn btn-success btn-sm rounded-pill">
                                            Restore
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#disposearchive<?= $archive->archive_id ?>">
                                            Delete
                                        </button>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <!-- <div style="min-height: 120px;"> -->
                                            <div class="collapse collapse-horizontal" id="disposearchive<?= $archive->archive_id ?>">
                                                <div class="card card-body" style="width: 300px;">
                                                Yakin Ingin Menghapus Arsip "<?= $archive->archive_title ?>" Secara Permanen?
                                                <div class="d-flex justify-content-end">
                                                    <a style="color: red; margin-right: 8px;" href="<?= base_url('archive/archive_delete/' . $archive->archive_code) ?>">Ya</a>
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
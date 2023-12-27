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
            <div class="card fw-semibold" id="content" style="font-size: 8pt; color: #000;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0"><?= $title ?></h2>
                    <a href="<?= base_url('archive/archive_assign/' . $archives[0]->archive_code . '#content') ?>" class="btn btn-success btn-sm mb-3 rounded-pill">Assign Dokumen</a>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor Dokumen</th>
                                <th>Judul</th>
                                <th>Perihal</th>
                                <th>Unit</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Update</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($archives as $document) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $document->document_no ?></td>
                                <td><?= $document->title ?></td>
                                <td><?= $document->subject ?></td>
                                <td><?= in_array($document->unit_code, ['', null]) ? 'ALL UNITS' : $document->unit_name ?></td>
                                <td><?= $document->category_name ?></td>
                                <td><?= $document->description ?></td>
                                <td>
                                    <?php if($document->file != null){ ?>
                                    <a href="<?= base_url('assets/upload/' . $document->file) ?>" target="_blank" style="font-size: 8pt; color: red;">Open File</a>
                                    <?php } else { ?>
                                        <?= 'No File Uploaded' ?>
                                    <?php } ?>
                                </td>
                                <td><?= date('d F Y', strtotime($document->assigned_at)) . ' by ' . $document->assigned_by ?></td>
                                <td><?= $document->assign_updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($document->assign_updated_at)) . ' by ' . $document->assign_updated_by ?></td>
                                <td>
                                <!-- delete vendor trigger modal -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deletedocument<?= $document->document_id ?>">
                                            TakeOut
                                        </button>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <!-- <div style="min-height: 120px;"> -->
                                            <div class="collapse collapse-horizontal" id="deletedocument<?= $document->document_id ?>">
                                                <div class="card card-body" style="width: 300px;">
                                                Yakin Ingin Take Out <?= $document->title ?>?
                                                <div class="d-flex justify-content-end">
                                                    <a style="color: red; margin-right: 8px;" href="<?= base_url('archive/archive_document_takeout/' . $document->document_no . '/' . $document->archive_code) ?>">Ya</a>
                                                    <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deletedocument<?= $document->document_id ?>" href="#">Tidak</a>
                                                </div>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                    <!-- update vendor trigger modal -->
                                    <a href="<?= base_url("archive/document_edit/$document->document_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal">
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
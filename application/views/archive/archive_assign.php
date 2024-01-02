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
                    <form action="<?= base_url('archive/archive_assign_add/' . $archive->archive_code) ?>" id="assignForm" method="post">
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="color:red; font-weight: bold;">ASSIGN</th>
                                <th>Nomor Dokumen</th>
                                <th>Judul</th>
                                <th>Perihal</th>
                                <th>Unit</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($documents as $document) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" form="assignForm" type="checkbox" value="<?= $document->document_no ?>" id="check-dokumen" name="check-dokumen[]">
                                    </div>
                                </td>
                                <td><?= $document->document_no ?></td>
                                <td><?= $document->title ?></td>
                                <td><?= $document->subject ?></td>
                                <td><?= $document->unit_code == null ? 'ALL UNITS' : $document->unit_name ?></td>
                                <td><?= $document->category_name ?></td>
                                <td><?= $document->description ?></td>
                                <td>
                                    <?php if ($document->file != null) { ?>
                                    <a href="<?= base_url('assets/upload/' . $document->file) ?>" target="_blank" style="font-size: 8pt; color: red;">Open File</a>
                                    <?php 
                                } else { ?>
                                        <?= 'No File Uploaded' ?>
                                    <?php 
                                } ?>
                                </td>
                                <td><?= date('d F Y', strtotime($document->created_at)) . ' by ' . $document->added_by ?></td>
                                <td><?= $document->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($document->updated_at)) . ' by ' . $document->updated_by ?></td>
                            </tr>

                            <?php 
                        } ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="reset" class="btn btn-secondary" style="margin-right: 8px;" action="action" onclick="window.history.go(-1); return false;">Back</button>
                        <input type="submit" value="Assign" class="btn btn-success" form="assignForm">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
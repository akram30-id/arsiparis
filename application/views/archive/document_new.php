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

    <div class="row justify-content-center mt-5">
        <div class="col-md-7">
            <div class="card px-4" id="content">
                <div class="card-body">
                    <h2 class="text-center mt-4 mb-5"><?= strtoupper($title) ?></h2>
                    <form action="<?= base_url('archive/document_add') ?>" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="document-no" class="form-label">Nomor Dokumen / Nomor Surat</label>
                                <input type="text" class="form-control" id="document-no" name="document-no" required>
                                <div class="invalid-feedback">
                                    Nomor Surat Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="title" class="form-label">Judul Dokumen / Judul Surat</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <div class="invalid-feedback">
                                    Judul Surat Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="subjek" class="form-label">Subjek</label>
                                <input type="text" class="form-control" id="subjek" name="subjek" required>
                                <div class="invalid-feedback">
                                    Subjek Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 col-md-12 mb-4">
                                <label for="unit" class="form-label">Unit Kerja</label>
                                <select class="form-select" name="unit" id="unit">
                                    <option value="">SELURUH UNIT / DOKUMEN PERUSAHAAN</option>
                                <?php foreach ($units as $s) { ?>
                                    <option value="<?= $s->unit_code ?>"><?= $s->unit_code . ' - ' . $s->unit_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-md-12 mb-4">
                                <label for="kategori" class="form-label">Kategori Dokumen / Surat</label>
                                <select class="form-select" name="kategori" id="kategori">
                                <?php foreach ($categories as $s) { ?>
                                    <option value="<?= $s->category_code ?>"><?= $s->category_code . ' - ' . $s->category_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Dokumen Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="file_document" class="form-label">Upload Softcopy</label>
                                <input class="form-control" type="file" id="file_document" name="file_document">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2 mb-3">
                            <input type="reset" value="Batal" class="btn btn-secondary btn-sm" style="margin-right: 8px;">
                            <input type="submit" value="Submit" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
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
                    <form action="<?= base_url('unit/update/' . $unit->unit_code) ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-unit" class="form-label">KODE UNIT</label>
                                <input type="text" class="form-control" id="kode-unit" value="<?= $unit->unit_code ?>" name="kode-unit" disabled>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="nama-unit" class="form-label">NAMA UNIT</label>
                                <input type="text" class="form-control" value="<?= $unit->unit_name ?>" id="nama-unit" name="nama-unit" required>
                                <div class="invalid-feedback">
                                    Nama Unit Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="deskripsi" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required><?= $unit->description ?></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Unit Wajib Diisi
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2 mb-3">
                            <input type="reset" value="Batal" class="btn btn-secondary btn-sm" style="margin-right: 8px;">
                            <input type="submit" value="Update" class="btn btn-warning btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
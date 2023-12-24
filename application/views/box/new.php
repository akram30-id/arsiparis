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
                    <form action="<?= base_url('box/add') ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="nama-vendor" class="form-label">KODE BOX</label>
                                <input type="text" class="form-control" id="kode-box" name="kode-box">
                                <small style="font-size: 8pt; color: red;"><i>Bila dikosongkan akan digenerate otomatis oleh sistem.</i></small>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">KODE RAK</label>
                                <select class="form-select" name="kode-rak" id="kode-rak" required>
                                <?php foreach ($shelfs as $s) { ?>
                                    <option value="<?= $s->shelf_code ?>"><?= $s->shelf_code . ' - RAK ' . $s->shelf_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Rak Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">KAPASITAS</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                                <div class="invalid-feedback">
                                    Kapasitas Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status-box" class="form-label">STATUS</label>
                                <?php $status = ['ACTIVE', 'INACTIVE'] ?>
                                <select class="form-select" name="status-box" id="status-box" required>
                                    <?php foreach ($status as $s) { ?>
                                    <option value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Status gedung wajib dipilih.
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi-box" id="deskripsi-box" rows="3" class="form-control" required></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Gedung Wajib Diisi
                                </div>
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
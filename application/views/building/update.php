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
                    <form action="<?= base_url('building/update/' . $buildings->building_id) ?>" method="POST" class="needs-validation" novalidate>

                    <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="nama-vendor" class="form-label">NAMA GEDUNG</label>
                                <input type="text" class="form-control" id="nama-gedung" value="<?= $buildings->building_name ?>" name="nama-gedung" required>
                                <div class="invalid-feedback">
                                    Nama Gedung Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">KODE GEDUNG</label>
                                <input type="text" class="form-control" id="kode-gedung" value="<?= $buildings->building_code ?>" name="kode-gedung" onclick="return false;" disabled required>
                                <div class="invalid-feedback">
                                    Kode Gedung Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status-gedung" class="form-label">STATUS</label>
                                <?php $status = ['ACTIVE', 'INACTIVE'] ?>
                                <select class="form-select" name="status-gedung" id="status-gedung" required>
                                    <?php foreach ($status as $s) { ?>
                                    <option <?php if($s == $buildings->status) echo "selected='selected'"; ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Status gedung wajib dipilih.
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">ALAMAT GEDUNG</label>
                                <textarea name="alamat-gedung" id="alamat-gedung" rows="3" class="form-control" required><?= $buildings->address ?></textarea>
                                <div class="invalid-feedback">
                                    Alamat Gedung Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi-gedung" id="deskripsi-gedung" rows="3" class="form-control" required><?= $buildings->description ?></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Gedung Wajib Diisi
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2 mb-3">
                            <button class="btn btn-secondary btn-sm" style="margin-right: 8px;" onclick="window.history.go(-1); return false;">Batal</button>
                            <input type="submit" value="Update" class="btn btn-warning btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
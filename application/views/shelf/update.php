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
                    <form action="<?= base_url('shelf/update/' . $shelf->shelf_code) ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-rak" class="form-label">KODE RAK</label>
                                <input type="text" class="form-control" id="kode-rak" value="<?= $shelf->shelf_code ?>" name="kode-rak" disabled>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="nama-rak" class="form-label">NAMA RAK</label>
                                <input type="text" class="form-control" id="nama-rak" value="<?= $shelf->shelf_name ?>" name="nama-rak" required>
                                <div class="invalid-feedback">
                                    Nama Rak Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">KODE RUANGAN</label>
                                <select class="form-select" name="kode-room" id="kode-room" required>
                                <?php foreach ($rooms as $s) { ?>
                                    <option <?php if($s->room_code == $shelf->room_code) echo 'selected="selected"' ?> value="<?= $s->room_code ?>"><?= $s->room_code ?> - <?= $s->room_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Room Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kategori" class="form-label">KATEGORI</label>
                                <select class="form-select" name="kategori" id="kategori" required>
                                <?php foreach ($categories as $c) { ?>
                                    <option <?php if($c->shelf_category_id == $shelf->category_id) echo 'selected="selected"' ?> value="<?= $c->shelf_category_id ?>"><?= $c->category_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Room Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status-rak" class="form-label">STATUS</label>
                                <?php $status = ['ACTIVE', 'INACTIVE'] ?>
                                <select class="form-select" name="status-rak" id="status-rak" required>
                                    <?php foreach ($status as $s) { ?>
                                    <option <?php if($s == $shelf->status) echo 'selected="selected"' ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Status Rak wajib dipilih.
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi-rak" id="deskripsi-rak" rows="3" class="form-control" required><?= $shelf->description ?></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Gedung Wajib Diisi
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
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
                    <form action="<?= base_url('room/update/' . $room->room_code) ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-ruangan" class="form-label">KODE RUANGAN</label>
                                <input type="text" class="form-control" id="kode-ruangan" name="kode-ruangan" value="<?= $room->room_code ?>" name="kode-ruangan" disabled>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="nama-ruangan" class="form-label">NAMA RUANGAN</label>
                                <input type="text" class="form-control" id="nama-ruangan" value="<?= $room->room_name ?>" name="nama-ruangan" required>
                                <div class="invalid-feedback">
                                    Nama Rak Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-building" class="form-label">PENEMPATAN GEDUNG</label>
                                <select class="form-select" name="kode-building" id="kode-building" required>
                                <?php foreach ($buildings as $s) { ?>
                                    <option <?php if($s->building_code == $room->building_code) echo 'selected="selected"' ?> value="<?= $s->building_code ?>"><?= $s->building_code . ' - ' . $s->building_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Building Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status-ruangan" class="form-label">STATUS</label>
                                <?php $status = ['ACTIVE', 'INACTIVE'] ?>
                                <select class="form-select" name="status-ruangan" id="status-ruangan" required>
                                    <?php foreach ($status as $s) { ?>
                                    <option <?php if($s == $room->status) echo 'selected="selected"' ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Status Rak wajib dipilih.
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-vendor" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi-ruangan" id="deskripsi-ruangan" rows="3" class="form-control" required><?= $room->description ?></textarea>
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
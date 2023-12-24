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
                    <form action="<?= base_url('user/add') ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="nama" class="form-label">NAMA</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                                <div class="invalid-feedback">
                                    Nama Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required>
                                <div class="invalid-feedback">
                                    NIK Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="role" class="form-label">ROLE USER</label>
                                <?php $roles = ['1 - Admin', '2 - Pimpinan', '3 - Staff'] ?>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="#" disabled>- PILIH ROLE -</option>
                                    <?php foreach ($roles as $s) { ?>
                                    <option value="<?= explode(' - ', $s)[0] ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    User Role wajib dipilih.
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="nomor-telepon" class="form-label">NOMOR TELEPON</label>
                                <input type="tel" class="form-control" id="nomor-telepon" name="nomor-telepon" required>
                                <div class="invalid-feedback">
                                    Nomor Telepon Wajib Diisi
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
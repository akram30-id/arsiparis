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

    <div class="container" id="content">
        <div class="row justify-content-center">
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('archive/document#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA DOKUMEN</h5>
                            <small>Kelola Data Dokumen / Surat Kearsipan</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-5 mb-4">
                <a href="<?= base_url('archive/archive#content') ?>">
                    <div class="card border-0 shadow" style="height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mt-5">DATA ARSIP</h5>
                            <small>Kelola Dokumen Yang Menjadi Arsip</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
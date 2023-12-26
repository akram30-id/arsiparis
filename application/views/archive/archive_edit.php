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
                    <form action="<?= base_url('archive/archive_update/' . $archive->archive_id) ?>" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-arsip" class="form-label">Kode Arsip</label>
                                <input type="text" class="form-control" value="<?= $archive->archive_code ?>" id="kode-arsip" name="kode-arsip-on" disabled required>
                                <input type="hidden" class="form-control" value="<?= $archive->archive_code ?>" id="kode-arsip-on" name="kode-arsip-on">
                                <div class="invalid-feedback">
                                    Kode Arsip Wajib Diisi
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="judul-arsip" class="form-label">Judul Arsip</label>
                                <input type="text" class="form-control" value="<?= $archive->archive_title ?>" id="judul-arsip" name="judul-arsip" required>
                                <div class="invalid-feedback">
                                    Judul Arsip Wajib Diisi
                                </div>
                            </div>

                            <div class="col-md-12 col-md-12 mb-4">
                                <label for="unit" class="form-label">Unit Kerja</label>
                                <select class="form-select" name="unit" id="unit">
                                    <option value="">SELURUH UNIT / DOKUMEN PERUSAHAAN</option>
                                <?php foreach ($units as $s) { ?>
                                    <option <?php if($s->unit_code == $archive->unit_code) echo 'selected="selected"' ?> value="<?= $s->unit_code ?>"><?= $s->unit_code . ' - ' . $s->unit_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="penyimpanan" class="form-label">Media Penyimpanan</label>
                                <select class="form-select" name="penyimpanan" id="penyimpanan" required>
                                <?php
                                $mediaPenyimpanan = ['RAK', 'BOX', 'DIGITAL']; 
                                foreach ($mediaPenyimpanan as $s) { ?>
                                    <option <?php if($archive->storage == $s) echo 'selected="selected"' ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Media Penyimpanan Wajib Diisi
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label for="status" class="form-label">Status Retensi Arsip</label>
                                <select class="form-select" name="status" id="status" <?php if(in_array($archive->archive_status, ['PERMANEN', null])) echo 'disabled' ?> required>
                                <?php
                                $status = ['RETENTION', 'PERMANEN']; 
                                foreach ($status as $s) { ?>
                                    <option <?php if($s == $archive->archive_status || $archive->archive_status == null) echo 'selected="selected"' ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Status Retensi Wajib Diisi
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="jadwal-retensi" class="form-label">Jadwal Retensi</label>
                                <select class="form-select" name="jadwal-retensi" id="jadwal-retensi" required <?php if(in_array($archive->archive_status, ['PERMANEN', null])) echo 'disabled' ?>>
                                <option value="">- PILIH JADWAL RETENSI -</option>
                                <?php
                                $schedule = ['TAHUNAN', 'BULANAN', 'HARIAN']; 
                                foreach ($schedule as $s) { ?>
                                    <option <?php if($s == $archive->retention_type) echo 'selected="selected"' ?> value="<?= $s ?>"><?= $s ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Jadwal Retensi Wajib Diisi
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="tanggal-retensi" class="form-label">Tanggal Retensi</label>
                                <input type="date" class="form-control" id="tanggal-retensi" name="tanggal-retensi" required <?php if(in_array($archive->archive_status, ['PERMANEN', null])) echo 'disabled' ?> value="<?= $archive->retention_date ?>">
                                <div class="invalid-feedback">
                                    Tanggal Retensi Wajib Diisi
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required><?= $archive->description ?></textarea>
                                <div class="invalid-feedback">
                                    Deskripsi Dokumen Wajib Diisi
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


<script type="text/javascript">
    $(document).ready(function () {
        $('#status').on('change', function () {
            let selected = $(this).find(':selected').val()
            if (selected == 'PERMANEN') {
                $('#jadwal-retensi').attr('disabled', true)
                $('#tanggal-retensi').attr('disabled', true)
            } else {
                $('#jadwal-retensi').attr('disabled', false)
                $('#tanggal-retensi').attr('disabled', false)
            }
            // console.info(selected)
        })
        
    })
</script>
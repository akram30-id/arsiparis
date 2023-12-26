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
                    <form action="<?= base_url('archive/assign_box_add') ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-arsip" class="form-label">KODE ARSIP</label>
                                <input type="text" class="form-control" id="kode-arsip" name="kode-arsip" value="<?= $archive_code ?>" disabled>
                                <input type="hidden" class="form-control" id="id-arsip" value="<?= $archive_id ?>" name="id-arsip">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-ruangan" class="form-label">PILIH RUANGAN</label>
                                <select class="form-select" name="kode-ruangan" id="kode-ruangan" required>
                                <option value="">- PILIH RUANGAN -</option>
                                <?php foreach ($rooms as $s) { ?>
                                    <option <?php if($archive_room == $s->room_code) echo 'selected="selected"' ?> value="<?= $s->room_code ?>"><?= $s->room_code . ' - ' . $s->room_name ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Ruangan Wajib Dipilih
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-rak" class="form-label">PILIH RAK</label>
                                <select class="form-select" name="kode-rak" id="kode-rak" required disabled>
                                    <option value="">- PILIH RAK -</option>
                                    <option selected value="<?= explode(' - ', $shelf)[0] ?>"><?= $shelf ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Rak Wajib Diisi
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-box" class="form-label">PILIH BOX</label>
                                <select class="form-select" name="kode-box" id="kode-box" required disabled>
                                    <option value="">- PILIH BOX -</option>
                                    <option selected value="<?= explode(' - ', $box)[0] ?>"><?= $box ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    Kode Box Wajib Diisi
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


<script>

    $(document).ready(function () {

        $("#kode-ruangan").on("change", function () {
            getShelf($(this).find(":selected").val())

            $("#kode-rak").on("change", function () {
                getBox($(this).find(":selected").val())
            })
        })


        const getShelf = function (room_code) {
            $.ajax({
                url: `<?= base_url('archive/get_shelf') ?>`,
                type: 'GET',
                dataType: 'json',
                data: {
                    room_code: room_code
                },
                success: function (response) {
                    $("#kode-rak").html("")
                    $("#kode-rak").append(`
                        <option value="">- PILIH RAK -</option>
                    `)
                    if (response.length > 0) {
                        $("#kode-rak").attr("disabled", false)
                        response.forEach(function (rak) {
                            $("#kode-rak").append(`
                                <option value="${rak.shelf_code}">${rak.shelf_code} - ${rak.shelf_name}</option>
                            `)
                            // console.info(rak)
                        })
                    } else {
                        $("#kode-rak").html("")   
                    }
                }
            })
        }


        const getBox = function (shelf_code) {
            $.ajax({
                url: `<?= base_url('archive/get_box') ?>`,
                type: 'GET',
                dataType: 'json',
                data: {
                    shelf_code: shelf_code
                },
                success: function (response) {
                    $("#kode-box").html("")
                    $("#kode-box").append(`
                        <option value="">- PILIH BOX -</option>
                    `)
                    // console.info(box)
                    if (response.length > 0) {
                        $("#kode-box").attr("disabled", false)
                        response.forEach(function (box) {
                            $("#kode-box").append(`
                                <option value="${box.box_code}">${box.box_code}</option>
                            `)
                        })
                    } else {
                        $("#kode-box").html("")   
                    }
                }
            })
        }


    })


</script>
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
                    <form action="<?= base_url('archive/assign_rak_add') ?>" method="POST" class="needs-validation" novalidate>

                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12 mb-4">
                                <label for="kode-arsip" class="form-label">KODE ARSIP</label>
                                <input type="text" class="form-control" id="kode-arsip" name="kode-arsip" value="<?= $archive_code ?>" disabled>
                                <input type="hidden" class="form-control" id="id-arsip" value="<?= $archive_id ?>" name="id-arsip">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kode-ruangan" class="form-label">PILIH RUANGAN</label>
                                <select class="form-select" name="kode-ruangan" id="kode-ruangan" required>
                                <?php foreach ($rooms as $s) { ?>
                                    <option value="<?= $s->room_code ?>"><?= $s->room_code . ' - ' . $s->room_name ?></option>
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
                                </select>
                                <div class="invalid-feedback">
                                    Kode Rak Wajib Diisi
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


<script>

    $(document).ready(function () {

        $("#kode-ruangan").on("load", function () {
            getShelf($(this).find(":selected").val())
        })

        $("#kode-ruangan").on("change", function () {
            getShelf($(this).find(":selected").val())
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
                    if (response.length > 0) {
                        $("#kode-rak").attr("disabled", false)
                        $("#kode-rak").html("")
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


    })


</script>
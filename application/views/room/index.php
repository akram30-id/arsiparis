<section class="section" style="margin-bottom: 164px;">

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
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
            <div class="card" id="content" style="font-size: 10pt;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0"><?= $title ?></h2>
                    <a href="<?= base_url('room/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah Data Ruangan</a>
                    <table class="table table-responsive table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Gedung</th>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Lokasi Ruangan</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Update</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($rooms as $room) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $room->building_code ?></td>
                                <td><?= $room->room_code ?></td>
                                <td><?= $room->room_name ?></td>
                                <td><?= $room->building_name ?></td>
                                <td><?= $room->description ?></td>
                                <td><?= $room->status ?></td>
                                <td><?= date('d F Y', strtotime($room->created_at)) . ' by ' . $room->added_by ?></td>
                                <td><?= $room->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($room->updated_at)) . ' by ' . $room->updated_by ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- delete room trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deleteRoom<?= $room->room_id ?>" aria-expanded="false" aria-controls="deleteRoom<?= $room->room_id ?>">
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-8 my-1">
                                            <!-- <div style="min-height: 120px;"> -->
                                                <div class="collapse collapse-horizontal" id="deleteRoom<?= $room->room_id ?>">
                                                    <div class="card card-body" style="width: 300px;">
                                                    Yakin Ingin Menghapus Ruangan <?= $room->room_name ?>?
                                                    <div class="d-flex justify-content-end">
                                                        <a style="color: red; margin-right: 8px;" href="<?= base_url('room/delete/' . $room->room_id) ?>">Ya</a>
                                                        <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deleteRoom<?= $room->room_id ?>" href="#">Tidak</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <!-- update room trigger modal -->
                                    <a href="<?= base_url("room/edit/$room->room_id#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal mb-1">
                                        Update
                                    </a>

                                    <!-- direct to detail room -->
                                    <a href="<?= base_url("room/room_detail/$room->room_code#content") ?>" class="btn btn-secondary btn-sm rounded-pill">
                                        Detail
                                    </a>
                                </td>
                            </tr>

                            <?php 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
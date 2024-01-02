<section class="section" style="margin-bottom: 164px;">

<div class="container">
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
            <div class="my-2">
                <button class="btn btn-danger btn-sm mb-1 rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Change My Password
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="<?= base_url('auth/reset') ?>" method="post" class="needs-validation" novalidate>
                            <div class="mb-2">
                                <label for="old-password" class="form-label">Password Lama</label>
                                <input type="password" class="form-control" id="old-password" name="old-password" required>
                                <div class="invalid-feedback">
                                    Password Lama Wajib Diisi
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="new-password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="new-password" name="new-password" required>
                                <div class="invalid-feedback">
                                    Password Baru Wajib Diisi
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                <div class="invalid-feedback">
                                    Konfirmasi Password Wajib Diisi
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2 mb-3">
                                <input type="submit" value="Reset Password" class="btn btn-warning btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card" id="content" style="font-size: 10pt;">
                <div class="card-body">
                    <h2 class="mt-3 mb-3 text-center border-0"><?= $title ?></h2>
                    <a href="<?= base_url('user/new#content') ?>" class="btn btn-primary btn-sm mb-3 rounded-pill">Tambah User</a> <br>
                    <small>Default Password: <b>dBSJkt#2023</b></small> <br>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>No. Telepon</th>
                                <th>Role</th>
                                <th>Unit Kerja</th>
                                <th>Dibuat Pada</th>
                                <th>Terakhir Diupdate</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->nik ?></td>
                                <td><?= $user->phone ?></td>
                                <td><?= $user->role == 1 ? 'ADMINISTRATOR' : (($user->role == 2) ? 'LEADER/MANAGER' : 'STAFF') ?></td>
                                <td><?= $user->unit_name ?></td>
                                <td><?= date('d F Y', strtotime($user->created_at)) . ' by ' . $user->added_by ?></td>
                                <td><?= $user->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($user->updated_at)) . ' by ' . $user->updated_by ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- delete user trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#deleteuser<?= $user->user_id ?>" aria-expanded="false" aria-controls="deleteuser<?= $user->user_id ?>">
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-8 my-1">
                                            <!-- <div style="min-height: 120px;"> -->
                                                <div class="collapse collapse-horizontal" id="deleteuser<?= $user->user_id ?>">
                                                    <div class="card card-body" style="width: 300px;">
                                                    Yakin Ingin Menghapus User <?= $user->username ?>?
                                                    <div class="d-flex justify-content-end">
                                                        <a style="color: red; margin-right: 8px;" href="<?= base_url('user/delete/' . $user->user_id) ?>">Ya</a>
                                                        <a style="color: red;" data-bs-toggle="collapse" data-bs-target="#deleteuser<?= $user->user_id ?>" href="#">Tidak</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <!-- update user trigger modal -->
                                    <a href="<?= base_url("user/edit/$user->nik#content") ?>" class="btn btn-warning btn-sm rounded-pill btn-modal mb-1">
                                        Update
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
</div>

</section>
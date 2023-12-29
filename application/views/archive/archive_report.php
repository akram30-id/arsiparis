<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title; ?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                font-size: 6pt;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #80030f;
                color: white;
            }
        </style>
    </head>
    <body>
        <div>
            <img src="<?= base_url('assets/img/logo/dbs.png') ?>" alt="" srcset="" style="width: 100px;">
            <p style="margin-top: -18px; font-size: 16pt;">Live More, Bank Less</p>
        </div>
        <div style="text-align:center">
            <h3><?= strtoupper($title) ?></h3>
            <p style="font-size: 14pt; margin-top: -10px; margin-bottom: 24px;"><u><?= $subtitle ?></u></p>
        </div>
        <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Arsip</th>
                <th>Judul Arsip</th>
                <th>Kode Box</th>
                <th>Nama Rak</th>
                <th>Unit</th>
                <th>Status</th>
                <th>Tipe Retensi</th>
                <th>Tanggal Retensi</th>
                <th>Tanggal Dibuat</th>
                <th>Terakhir Update</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($archives as $archive) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $archive->archive_code ?> <?= ($archive->box_code == null && $archive->shelf_code == null) ? '<span>(DIGITALIZED)</span>' : '' ?></td>
                <td><?= $archive->archive_title ?></td>
                <td><?= in_array($archive->box_code, ["", null]) ? "NOT STORED IN ANY BOX" : $archive->box_code ?></td>
                <td><?= in_array($archive->shelf_code, ["", null]) ? "NOT STORED IN ANY SHELF" : $archive->shelf_name ?></td>
                <td><?= $archive->unit_code == null ? 'ALL UNITS' : $archive->unit_name ?></td>
                <td><?= $archive->archive_status ?></td>
                <td class="text-primary"><?= $archive->archive_status == 'PERMANEN' ? '#PERMANENT' : $archive->retention_type ?></td>
                <td class="text-danger"><?= $archive->archive_status == 'PERMANEN' ? '#PERMANENT' : date('d F Y', strtotime($archive->retention_date)) ?></td>
                <td><?= $archive->description ?></td>
                <td><?= date('d F Y', strtotime($archive->created_at)) . ' by ' . $archive->added_by ?></td>
                <td><?= $archive->updated_at == null ? '<i>belum pernah update</i>' : date('d F Y', strtotime($archive->updated_at)) . ' by ' . $archive->updated_by ?></td>
            </tr>

            <?php 
        } ?>
            </tbody>
        </table>
    </body>
</html>
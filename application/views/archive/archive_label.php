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
                border: 0px solid #ddd;
                padding: 0px;
            }

            #table th {
                padding-top: 4;
                padding-bottom: 4px;
                text-align: left;
                color: white;
            }
        </style>
    </head>
    <body>
        <div>
            <img src="<?= base_url('assets/img/logo/dbs.png') ?>" alt="" srcset="" style="width: 64px;">
            <p style="margin-top: -10px; font-size: 9pt;">Live More, Bank Less</p>
        </div>
        <div style="text-align:center; margin-bottom: -20px;">
            <h5><?= strtoupper($title) ?></h5>
            <p style="font-size: 8pt; margin-top: -10px; margin-bottom: 24px;"><u><?= $subtitle ?></u></p>
        </div>
        <table id="table">
            <tr>
                <td width="30%" rowspan="4">
                    <img src="<?= base_url('assets/qrcode/' . $archives->archive_code) ?>.png" style="width: 100px; margin-top: 32px;" alt="">
                </td>
                <tr>
                    <td>
                        <p style="font-weight: bold;">Kode Arsip: <?= $archives->archive_code ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            Penyimpanan: <?= $archives->storage ?> - 
                            <?php if($archives->storage == 'RAK') echo $archives->shelf_name . " ($archives->shelf_code)" ?>
                            <?php if($archives->storage == 'BOX') echo $archives->box_code . " (Rak $archives->shelf_name)" ?>
                            <?php if($archives->storage == 'DIGITALIZED') echo "DIGITALIZED" ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Pencipta Arsip: <?= $archives->name . ' - ' . $archives->nik ?></p>
                    </td>
                </tr>
            </tr>
        </table>
    </body>
</html>
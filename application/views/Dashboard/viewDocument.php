<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png/jpg" href="<?= base_url()?>tamplate/picture/LogoTAG.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>tamplate/assets/css/view.css" />

    <title>File Document - Tunas Auto Graha</title>
</head>
<body>
    <div class="header-Views">
        <?php if ($this->uri->segment(1) == "Document") { ?>
            <a href="<?=base_url('Document/fileDocument/' .  $dataDocument->doc_folder)?>" class="aBack"><i class="fa-solid fa-left-long"></i></a>
        <?php } else if ($this->uri->segment(1) == "Assigned") {?>
            <a href="<?=base_url('Assigned/assignedDocument/' .  $dataDocument->doc_folder)?>" class="aBack"><i class="fa-solid fa-left-long"></i></a>
        <?php } ?>
        <a href="<?=base_url('Document/docDownload/'. $dataDocument->doc_id)?>" class="aDownload"><i class="fa-solid fa-down-long"></i></a>
        <div class="header-body">
            <span><?= $dataDocument->doc_name ?></span>
        </div>
    </div>
    <div class="body-Views">
        <embed src="<?= base_url('tamplate/documents/' . $dataDocument->doc_name) ?>" type="">
    </div>
</body>
</html>
<div class="card-container">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-md" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created Date</th>
                        <th>Expired Date</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($assignedFile as $key => $value) { ?>
                    <tr style="background : white;">
                        <td><?= $key+1 ?></td>
                        <td>
                            <?php if ($value->folder_status == 1) { ?>
                                <a href="<?= base_url('Assigned/assignedDocument/' . $value->sfdoc_sfid ) ?>"
                                style="color : black; text-decoration : none;"><i class="<?= $value->folder_icon ?>" style="margin-right: 3px;"></i> <?= $value->folder_name ?></a></td>
                            <?php } else { ?>
                                <a href="<?=base_url('Assigned/viewDFolder/'. $value->folder_id )?>" style="color : black; text-decoration : none;">
                                    <i class="<?= $value->folder_icon ?>" style="margin-right: 6px;"></i> <span> <?= $value->folder_name ?> </span>
                                </a>
                            <?php } ?>
                        <td><?= $value->sfdoc_date ?></td>
                        <td>-</td>
                        <td><?= $value->folder_user ?></td>
                    </tr>
                <?php } ?>
                        
                </tbody>
            </table>
        </div>
    </div>
</div>
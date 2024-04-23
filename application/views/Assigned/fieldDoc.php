<div class="card-container">
    <div class="card-body">
        <div class="button-Doc">
            <button class="btn btn-outline-info" onclick="openDocument()"><i class="fa-solid fa-plus"></i>
                Add Document
            </button>
        </div>
        <a href="<?= base_url('Assigned') ?>" class="linkBack" style="color: rgb(35, 157, 155); text-decoration : none;"> <span><< / <?= $id->folder_name ?></span></a>
        <div class="row">
            <div class="form-group col-6">
                <?= $this->session->flashdata('message'); ?>
            </div>      
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-md" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description File</th>
                        <th>Created Date</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($folderDoct as $key => $value) { ?>
                    <tr style="background : white;">
                        <td><?= $key+1 ?></td>
                        <td>
                            <a href="<?=base_url('Assigned/viewData/'. $value->doc_id )?>" style="color : black; text-decoration : none;">
                            <i class="<?= $value->doc_icon ?>" style="margin-right: 6px;"></i>
                            <span> <?= $value->doc_name ?> </span>
                            </a>
                        </td>
                        <td><?= $value->doc_desc ?></td>
                        <td><?= $value->doc_date ?></td>
                        <td><?= $value->doc_user ?></td>
                    </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="addDocument" id="popDocument">
        <button onclick="closeDocument()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Add Document</h3>
        <div class="inputDocument">
            <form action="<?= site_url('Assigned/insertDocument/' . $id->folder_id) ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Document upload</label>
                    <div class="custom-file">
                        <input type="file" name="documentFile" id="documentFile" class="custom-file-input" onchange="priviewFile()" required>
                        <label class="custom-file-label" for="file">No file choosen</label>
                    </div>
                </div>
                <div class="form-group col-11">
                    <label for="">Description</label>
                    <div class="form-floating">
                        <textarea class="form-control" id="floatingTextarea" name="descFile" required></textarea>
                    </div>
                </div>
                <div class="buttonInput">
                    <button type="submit" class="btn btn-success" style="font-size : 12px; letter-spacing: 1px;">Save</button>
                    <button type="reset" class="btn btn-secondary" style="font-size : 12px; letter-spacing: 1px;">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>

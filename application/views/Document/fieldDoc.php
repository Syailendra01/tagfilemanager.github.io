<div class="card-container">
    <div class="card-body">
        <div class="button-Doc">
            <button class="btn btn-outline-info" onclick="openDocument()"><i class="fa-solid fa-plus"></i>
                Add Document
            </button>
        </div>
        <a href="<?= base_url('Document') ?>" class="linkBack" style="color: rgb(35, 157, 155); text-decoration : none;"> <span><< / <?= $id->folder_name ?></span></a>
        <div class="row">
            <div class="form-group col-6">
                <?= $this->session->flashdata('message'); ?>
            </div>  
        </div>
        <form action="<?= base_url('Document/actionDownload')?>" method="POST">
            <div class="table-responsive">
                <table class="table table-striped table-md" id="table1">
                    <div class="button-process">
                        <button type="submit" name="downloadBtn"><i class="fa-solid fa-download" style="margin-right : 10px;"></i> Download</button>
                    </div>
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAlldata" onchange="selectAll(this)"></th>
                            <th>Name</th>
                            <th>Description File</th>
                            <th>Created Date</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($folderDoct as $key => $value) { ?>
                        <tr style="background : white;">
                            <td>
                                <input type="text" value="<?=$value->doc_folder?>" name="idDocFolder" hidden>
                                <input type="checkbox" class="chooseData" name="checkedDocument[]" id="" value="<?=$value->doc_id?>">
                            </td>
                            <td>
                                <a href="<?=base_url('Document/viewData/'. $value->doc_id )?>" style="color : black; text-decoration : none;">
                                    <i class="<?= $value->doc_icon ?>" style="margin-right: 6px;"></i>
                                    <span> <?= $value->doc_name ?> </span>
                                </a>
                            </td>
                            <td><?= $value->doc_desc ?></td>
                            <td><?= $value->doc_date ?></td>
                            <td><?= $value->doc_user ?></td>
                            <td>
                                <div class="actionContent">
                                    <a href="<?= base_url('Document/deleteDocument/' . $value->doc_id) ?>" onclick="return confirm('Apakah anda ingin menghapus document tersebut?')"><i class="fa-solid fa-trash"></i></a>
                                    <span style="font-size : 18px; padding: 0 15px 0 15px; cursor: default;">|</span>
                                    <button type="button" style="outline: none;" id="updateButton<?= $value->doc_id ?>" onclick="open_popupUpdate('<?= $value->doc_id ?>')" value="<?= $value->doc_id ?>"><i class="fa-solid fa-pencil"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="addDocument" id="popDocument">
        <button onclick="closeDocument()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Add Document</h3>
        <div class="inputDocument">
            <form action="<?= site_url('Document/insertDocument/' . $id->folder_id) ?>" method="post" enctype="multipart/form-data" autocomplete="off">
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

    <div class="popupUpdate" id="editDocument">
        <button onclick="close_popupUpdate()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Edit <span style="color:red; margin-left: 5px;">Document</span></h3>
            <form action="<?= site_url('Document/updateDocument') ?>" method="post" enctype="multipart/form-data" >
                <div class="editDocument" id="updateCondition">
                                        
                </div>
            </form>
    </div>

</div>
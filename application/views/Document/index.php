<div class="card-container">
    <div class="card-body">
        <div class="button-input">
            <button class="btn btn-outline-info" onclick="openFolder()"><i class="fa-solid fa-folder-plus"></i>
                Create folder
            </button>
            <button class="btn btn-outline-info" onclick="openDocument()"><i class="fa-solid fa-plus"></i>
                Add Document
            </button>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <?= $this->session->flashdata('message'); ?>
            </div>  
        </div>
        <form action="<?= base_url('Document/actionData')?>" method="POST">
            <div class="table-responsive" style="margin-top:4%;">
                <table class="table table-striped table-md" id="table1">
                    <div class="button-process">
                        <button type="submit" name="shareBtn"><i class="fa-solid fa-share-nodes" style="margin-right: 10px;"></i> Share</button>
                        <button type="submit" name="downloadBtn"><i class="fa-solid fa-download" style="margin-right: 10px;"></i> Download</button>
                    </div>
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAlldata" onchange="selectAll(this)"></th>
                            <th>Name</th>
                            <th>Created Date</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($folderFile as $key => $value) { ?>
                        <tr style="background : white;">
                            <td><input type="checkbox" class="chooseData" name="checkedData[]" id="checkedData" value="<?=$value->folder_id?>"></td>
                            <td>
                                <?php if ($value->folder_status == 1) { ?>
                                    <a href="<?= base_url('Document/fileDocument/' . $value->folder_id ) ?>"
                                    style="color : black; text-decoration : none;"><i class="<?= $value->folder_icon ?>" style="margin-right: 3px;"></i> <?= $value->folder_name ?></a></td>
                                <?php } else { ?>
                                    <a href="<?=base_url('Document/viewDFolder/'. $value->folder_id )?>" style="color : black; text-decoration : none;">
                                        <i class="<?= $value->folder_icon ?>" style="margin-right: 6px;"></i> <span> <?= $value->folder_name ?> </span>
                                    </a>
                                <?php } ?>
                            <td><?= $value->folder_created ?></td>
                            <td><?= $value->folder_user ?></td>
                            <td>
                                <div class="actionContent">
                                    <a href="<?= base_url('Document/deleteFolder/' . $value->folder_id ) ?>"
                                    onclick="return confirm('Apakah anda ingin menghapus document tersebut?')"><i class="fa-solid fa-trash"></i></a>
                                    <span style="font-size : 18px; padding: 0 15px 0 15px; cursor: default;">|</span>
                                    <button type="button" style="outline: none;" id="editButton<?= $value->folder_id ?>" onclick="open_popupEdit('<?= $value->folder_id ?>')" value="<?= $value->folder_id ?>"><i class="fa-solid fa-pencil"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="createFolder" id="popFolder">
        <button onclick="closeFolder()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Create Folder</h3>
        <div class="inputFolder">
            <form action="<?= site_url('Document/createFolder') ?>" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text" style="cursor: default; font-size: 14px; letter-spacing: 0.5px;">Folder Name</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="inputFolder" id="inputFolder" required>
                </div>
                <div class="buttonInput">
                    <button type="submit" class="btn btn-success" style="font-size : 12px; letter-spacing: 1px;"> <i class="fa-solid fa-folder-plus"></i> Created</button>
                </div>
            </form>
        </div>
    </div>

    <div class="addDocument" id="popDocument">
        <button onclick="closeDocument()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Add Document</h3>
        <div class="inputDocument">
            <form action="<?= site_url('Document/createDocument') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Document upload</label>
                    <div class="custom-file">
                        <input type="file" name="documentUpload" id="documentUpload" class="custom-file-input" onchange="priviewDocument()" required>
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

    <div class="popupEdit" id="editFolder">
        <button onclick="close_popupEdit()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Edit <span style="color:red; margin-left: 5px;">Document</span></h3>
            <form action="<?= site_url('Document/editFolders') ?>" method="post" enctype="multipart/form-data" >
                <div class="editFolder" id="editCondition">
                                        
                </div>
            </form>
    </div>
</div>

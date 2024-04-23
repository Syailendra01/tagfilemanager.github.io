<div class="card-container">
    <div class="card-body">
        <div class="button-Doc">
            <button class="btn btn-outline-info" onclick="openFormaccount()"><i class="fa-solid fa-plus"></i>
                Add new user
            </button>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <?= $this->session->flashdata('message'); ?>
            </div>  
        </div>
        <br> <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-md" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Divisi Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataAccount as $key => $value) { ?>
                        <tr style="background : white;">
                            <td><?= $key+1 ?></td>
                            <td style="color: blue;"><?= $value->emailUsers?></td>
                            <td><?= $value->passwordUsers?></td>
                            <td style="color: red;"><?= $value->nameUsers ?></td>
                            <td><?= $value->diviUnits?></td>
                            <td>
                                <div class="actionContent">
                                    <a href="<?= base_url('makeUsers/deleteAccount/' . $value->idUsers ) ?>"
                                    onclick="return confirm('Apakah anda ingin menghapus document tersebut?')"><i class="fa-solid fa-trash"></i></a>
                                    <span style="font-size : 18px; padding: 0 15px 0 15px; cursor: default;">|</span>
                                    <button type="button" style="outline: none;" id="editAccount<?= $value->idUsers ?>" onclick="open_popupAccount('<?= $value->idUsers ?>')" value="<?= $value->idUsers ?>"><i class="fa-solid fa-pencil"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                        
                </tbody>
            </table>
        </div>
    </div>
    <div class="addUsers" id="popForm">
        <button onclick="closeFormaccount()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Account User</h3>
        <div class="inputDocument">
            <form action="<?= site_url('makeUsers/insertAcccount') ?>" method="POST">
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Email Users</label>
                    <input type="email" class="form-control" name="emailUsers" required >
                </div>
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Password Users</label>
                    <input type="password" class="form-control" name="passwordUsers" required >
                </div>
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Nama Users</label>
                    <input type="text" class="form-control" name="namaUsers" required >
                </div>
                <div class="form-group col-9" style="margin-bottom: 20px;">
                    <label for="" >Divisi Unit</label>
                    <input type="text" class="form-control" name="divition" required >
                </div>
                <div class="buttonInput" style="margin: 20px 15px;">
                    <button type="submit" class="btn btn-success" style="font-size : 12px; letter-spacing: 1px;">Save</button>
                    <button type="reset" class="btn btn-secondary" style="font-size : 12px; letter-spacing: 1px;">Clear</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="popupAccount" id="editAccount">
        <button onclick="close_popupAccount()" class="buttonClose"><i class="fa-regular fa-rectangle-xmark"></i></button>
        <h3>Edit <span style="color:red; margin-left: 5px;">Users</span></h3>
            <form action="<?= site_url('makeUsers/upadateAccount') ?>" method="POST">
                <div class="editAUsers" id="ConditionFile">

                </div>
            </form>
    </div>
</div>
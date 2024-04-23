</div>

<script src="<?= base_url() ?>/tamplate/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>/tamplate/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/tamplate/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/tamplate/assets/js/custom.js"></script>

<script>

    // Folder 
    let popUp = document.getElementById("popFolder");

    function openFolder() {
        popUp.classList.add("openFolder-popUp");
    }
    function closeFolder() {
        popUp.classList.remove("openFolder-popUp");
    }

    //Document
    let popDoc = document.getElementById("popDocument");

    function openDocument() {
        popDoc.classList.add("openDoc-popUp");
    }
    function closeDocument() {
        popDoc.classList.remove("openDoc-popUp");
    }

   
</script>

<script>
    let popForm = document.getElementById("popForm");

    function openFormaccount() {
        popForm.classList.add("openUsers-popUp");
    }
    function closeFormaccount() {
        popForm.classList.remove("openUsers-popUp");
    }
    </script>

<script>

    let popupEdit = document.getElementById("editFolder");
    function open_popupEdit(id) {
        popupEdit.classList.add("open-popupEdit"); 

        var getType = $("#editButton"+id).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>Document/editCode",
                data: {
                    id : getType
                },
                success : function (result) {
                    let data = JSON.parse(result);
                    
                    document.querySelector("#editCondition").innerHTML = data;
                    console.log(result);
                }
                
            });
    }
    function close_popupEdit() {
        popupEdit.classList.remove("open-popupEdit");
    }

</script>

<script>
    let popupAccount = document.getElementById("editAccount");
    function open_popupAccount(id) {
        popupAccount.classList.add("open-popupAccount"); 

        var getType = $("#editAccount"+id).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>makeUsers/editAccount",
                data: {
                    idUser : getType
                },
                success : function (result) {
                    let data = JSON.parse(result);
                    
                    document.querySelector("#ConditionFile").innerHTML = data;
                    console.log(result);
                }
                
            });
    }
    function close_popupAccount() {
        popupAccount.classList.remove("open-popupAccount");
    }
</script>

<script>

    let popupUpdate = document.getElementById("editDocument");
    function open_popupUpdate(id) {
        popupUpdate.classList.add("openUpdate-popUp"); 

        var getType = $("#updateButton"+id).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>Document/updateCode",
                data: {
                    id : getType
                },
                success : function (result) {
                    let data = JSON.parse(result);
                    
                    document.querySelector("#updateCondition").innerHTML = data;
                    console.log(result);
                }
                
            });
    }
    function close_popupUpdate() {
        popupUpdate.classList.remove("openUpdate-popUp");
    }

</script>

<script>
    function priviewDocument() {
        const Document = document.querySelector("#documentUpload");
        const fileDocument = document.querySelector(".custom-file-label");

        fileDocument.textContent = Document.files[0].name;

        const fileFiles = new FileReader();
        fileFiles.readAsDataURL(Document.files[0]);
    }

    function priviewFile() {
        const File = document.querySelector("#documentFile");
        const fileDocument = document.querySelector(".custom-file-label");

        fileDocument.textContent = File.files[0].name;

        const fileFiles = new FileReader();
        fileFiles.readAsDataURL(File.files[0]); 
    }
</script>

<script>
    function selectAll(input) {
        let checkboxes = document.querySelectorAll('.chooseData');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = input.checked;
        });
    }

    $(".checkAlldata ").click(function() {
        if($(this).is(":checked")) {
            $(".button-process").show(300);
        } else {
            $(".button-process").hide(200);
        };
    });

    $(".chooseData ").click(function() {
        if($(this).is(":checked")) {
            $(".button-process").show(300);
        } else {
            $(".button-process").hide(200);
        };
    });
</script>
</body>
</html>
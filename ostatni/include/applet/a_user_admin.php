         <input type="hidden" id="ID" name="ID" value="0">
               <div class="row form-group">
                    <div class="col-md-2">
                        <label class="m-2" for="title_f">Tit.</label>
                        <input type="text" class="form-control" id="title_f" name="title_f">
                    </div>
                    <div class="col-md-4">
                        <label class="m-2" for="first_name">Jméno (*)</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="col-md-4">
                        <label class="m-2" for="last_name">Příjmení (*)</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="col-md-2">
                        <label class="m-2" for="title_p">Tit.</label>
                        <input type="text" class="form-control" id="title_p" name="title_p">
                    </div>
                </div>
                <div class="row form-group">
                        <div class="col-md-6">
                            <label class="m-2" for="email" required="required">Email (*!)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label class="m-2" for="phone">Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="m-2" for="username">Přihlašovací jméno (!)</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
<?php if ($scriptName=="user_admin") { ?>
                        <div class="form-group">
                            <label class="m-2" for="funkce">Funkce (*)</label>
                            <select class="form-control" id="funkce" name="funkce" onchange="onUserDone(this);">
                                <option value="0" selected disbled> --- Vyberte funkci/oprávnění ---</option>
<?php
$sql = "SELECT * from `RSP_CC_USER_Func`";
$result = $conn->query($sql);
while ($U=$result->fetchObject()) { ?>
                                <option value="<?php echo $U->ID;?>"><?php echo $U->descr;?></option>
<?php } ?>
                            </select>
                        </div>
<?php } else { ?>
         <input type="hidden" id="funkce" name="funkce" value="23" onchange="onUserDone(this);">
<?php } ?>
                        <div style="font-size: 0.6em;">
                            <br/>Vysvětlivka: Položky s (*) jsou povinné; položky s (!) musí být unikátní v rámci systému
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="m-2" for="password" required="required">Heslo</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="m-2" for="password_confirm" required="required">Potvrzení hesla</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        </div>
                        <div class="form-group" style="display:<?php echo (($scriptName=="user_admin")?"block":"none");?> ;">
                            <label class="m-2" for="active">Aktivní</label>
                            <input type="checkbox" id="active" name="active" checked>
                        </div>
                    </div>
                    <div style="height:2em;"></div>
                </div>
<script>
    function aUserEmpty() {
            $("#ID").val(0);
            $("#username").val("");
            $("#email").val("");
            $("#password").val("");
            $("#password_confirm").val("");
            $("#first_name").val("");
            $("#last_name").val("");
            $("#title_p").val("");
            $("#title_f").val("");
            $("#phone").val("");
            $("#funkce").val(0);
            $("#active").prop( "checked", true );
            $("#editorNote").val("");
    }
    function aUserLoad(index) {
        $.getJSON( "include/ajax/getUsers.php?typ=4&id="+index, function( data ) {
            $("#ID").val(index);
            $("#username").val(data[0]['Login']);
            $("#email").val(data[0]['Mail']);
            $("#password").val("");
            $("#password_confirm").val("");
            $("#first_name").val(data[0]['FirstName']);
            $("#last_name").val(data[0]['LastName']);
            $("#title_p").val(data[0]["TitleP"]);
            $("#title_f").val(data[0]["TitleF"]);
            $("#phone").val(data[0]["Phone"]);
            $("#funkce").val(data[0]["Func"]);
            $("#active").prop( "checked", (data[0]["Active"]==1) );
            $("#editorNote").val("");
        });    
    }
    function aUserPost(myNote) {
      var inField={
            "": "",
            "ID" : "",
            "Login" : "#username",
            "Mail" : "#email",
            "passwd1" : "#password",
            "passwd2" : "#password_confirm",
            "FirstName" : "#first_name",
            "LastName" : "#last_name",
            "TitleP" : "#title_p",
            "TitleF" : "#title_f",
            "Phone" : "#phone",
            "Func" : "#funkce",
            "Active" : "#Active",
            "note" : "#editorNote"
        };
        $(".alert-danger").removeClass("alert-danger");
        $.post("include/ajax/registerAuthor.php", {
            "ID" : $("#ID").val(),
            "Login" : $("#username").val(),
            "Mail" : $("#email").val(),
            "passwd1" : $("#password").val(),
            "passwd2" : $("#password_confirm").val(),
            "FirstName" : $("#first_name").val(),
            "LastName" : $("#last_name").val(),
            "TitleP" : $("#title_p").val(),
            "TitleF" : $("#title_f").val(),
            "Phone" : $("#phone").val(),
            "Func" : $("#funkce").val(),
            "Active" : $("#active").is(":checked"),
            "note" : myNote
        },
        function(data, status) {
            if (status === "success") {
                const d = JSON.parse(data);
                if (d["status"]==1) {
                    alert(d["message"]);
                    $("#funkce").val(0).change();
                } else {
                    if (inField[d["param"]]!="") {
                        $(inField[d["param"]]).addClass("alert-danger");}
                    alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
                }
            } else {
                alert("Nepodařilo se odeslat data na server.");
            }
        });
    }
</script>
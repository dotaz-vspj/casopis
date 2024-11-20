         <input type="hidden" id="ID" name="ID" value="0">
            <div class="form-group">
                <label for="editionTitle">Název vydání</label>
                <input type="text" class="form-control" id="editionTitle" placeholder="Zadejte název vydání">
                <input type="hidden" id="editionID" name="editionID">
            </div>
            <div class="form-group">
                <label for="editionText">Téma vydání</label>
                <textarea class="form-control" id="editionText" rows="4" placeholder="Zadejte Téma vydání"></textarea>
            </div>
            <div class="form-group">
                <label class="m-2" for="published">Datum publikace</label>
                <input type="date" class="form-control" id="published" name="published">
            </div>
<script>
    function aFormEmpty() {
        $("#edit_header").html("Vložení nového vydání");
            $("#editionID").val(0);
            $("#editionTitle").val("");
            $("#editionText").val("");
            $("#published").val("");
            $("#editorNote").val("");
    }
    function aFormLoad(index) {
        $("#edit_header").html("Úprava vydání");
        $.getJSON( "include/ajax/getEditions.php?typ=0&id="+index, function( data ) {
            $("#editionID").val(index);
            $("#editionTitle").val(data[0]['Title']);
            $("#editionText").val(data[0]['Thema']);
            $("#published").val(data[0]['Published']);
            $("#editorNote").val("");
        });    
    }
    function aPost() {
      var inField={
            "": "",
            "ID" : "",
            "Title" : "#editionTitle",
            "Thema" : "#editionText",
            "Published" : "#published",
            "note" : "#editorNote"
        };
        $(".alert-danger").removeClass("alert-danger");
        $.post("include/ajax/setEditionAdmin.php", {
            "ID" : $("#editionID").val(),
            "Title" : $("#editionTitle").val(),
            "Thema" : $("#editionText").val(),
            "Published" :  $("#published").val(),
            "note" : $("#editorNote").val()
        },
        function(d, status) {
            if (status === "success") {
                if (d["status"]==1) {
                    alert(d["message"]);
                    editionsLoad(0,0);
                    messagesLoad(5,0);
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
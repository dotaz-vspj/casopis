<?php ?>
<div id="contMain" style="display:none; ">
    <h5 class="mb-5" id="edit_header">Vložení/úprava článku</h5>
            <div class="form-group">
                <label for="articleTitle">Název článku</label>
                <input type="text" class="form-control" id="articleTitle" placeholder="Zadejte název článku">
                <input type="hidden" id="articleID" name="articleID">
            </div>

            <!-- Sekce pro výběr autorů -->
            <div class="form-group author-selectors">
                <!-- Autoři článku -->
                <div class="w-50">
                    <label for="selectedAuthors">Autoři článku</label>
                    <select multiple class="form-control" id="selectedAuthors" size="5">
                    </select>
                    <input type="hidden" id="authors" name="authors">
                </div>

                <!-- Šipky pro přesouvání autorů -->
                <div class="arrows">
                    <button type="button" class="btn btn-outline-secondary" onclick="authorAdd();">&larr;</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="authorRemove();">&rarr;</button>
                </div>

                <!-- Registrovaní autoři -->
                <div class="w-50">
                    <label for="registeredAuthors">Registrované osoby <input type="checkbox" id="authors_only" onchange="filterAuthors();"> jen autoři</label>
                    <select class="form-control" id="registeredAuthors">
                        <option disabled selected>Selhalo načtení autorů</option>
                    </select>
                     <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#newAuthorModal">Registrovat neevidovaného autora</button>
                </div>
            </div>

            <div class="form-group">
                <label for="articleText">Abstrakt článku</label>
                <textarea class="form-control" id="articleText" rows="4" placeholder="Zadejte abstrakt článku"></textarea>
            </div>

            <div class="form-group">
                <label for="editorNote">Poznámka pro redakci</label>
                <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte poznámku pro redakci"></textarea>
            </div>
            <div id="edit_restricted">
            </div>

            <div class="form-buttons">
                <select id="edice" name="edice" style="width: 120px;">
                    <option disabled selected>Žádná dostupná edice</option>
                </select>

                <!-- Custom file input for document -->
                <label class="btn btn-primary" id="document-btn" for="document">Upload Document</label>
                <input class="form-control" id="document" name="document" type="file" style="display: none;">

                <!-- Custom file input for image -->
                <label class="btn btn-primary" id="image-btn" for="image">Upload Image</label>
                <input class="form-control" id="image" name="image" type="file" style="display: none;">

                <button class="btn btn-success" onclick="aPost()">Uložit</button>
            </div>
         <!-- Modal for new author registration -->
<div class="modal fade" id="newAuthorModal" tabindex="-1" aria-labelledby="newAuthorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAuthorModalLabel">Registrace nového autora</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
            </div>
            <div class="modal-body">
<?php include 'include/applet/a_user_admin.php'; ?>
                    <button type="button" class="btn btn-primary" onclick="registerNewAuthor()">Registrovat</button>
            </div>
        </div>
    </div>
</div></div>
<script>
    function editionsLoad(type,index){
        $.getJSON( "include/ajax/getEditions.php?typ="+type+"&id="+index, function( data ) {
            var l_html="<option disabled selected>Vyberte Edici</option>\n";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<option value="',e['ID'],'">',e['ID'],':',e['Title'],"</option>\n");
            });
            $( "#edice" ).html( l_html );
        });    
    }
    function authorsLoad(type,index){
        $.getJSON( "include/ajax/getUsers.php?typ="+type+"&id="+index, function( data ) {
            var l_html="<option value=\"0\" disabled selected>Vyberte autora</option>\n";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<option value="',e['ID'],'">',e['ID'],':',((e['TitleF']!=null)?e['TitleF']+' ':''),e['LastName'],', ',e['FirstName'],((e['TitleP']!=null)?', '+e['TitleP']:''),"</option>\n");
            });
            $( "#registeredAuthors" ).html( l_html );
        });    
    }
    function filterAuthors() {
        if ($('#authors_only').is(':checked')) authorsLoad(2,0);
        else authorsLoad(1,0);
    }
    function authorRemove() {
        $("#selectedAuthors :selected").remove();
        var arr=[];$("#selectedAuthors option").each(function(){arr.push($(this).val());});
        $("#authors").val(arr);
    }
    function authorAdd() {
        var authorAdd= $( "#registeredAuthors :selected" );
        if ((authorAdd.val()!="0")&&($.inArray(authorAdd.val(),$("#authors").val().split(','))==-1)){
            $("#selectedAuthors").append($('<option>', {
                value: authorAdd.val(),
                text: authorAdd.text()
            }));
        $("#registeredAuthors").val("0");
        }
        var arr=[];$("#selectedAuthors option").each(function(){arr.push($(this).val());});
        $("#authors").val(arr);
    }
    function aFormEmpty() {
        $("#edit_header").html("Vložení nového článku");
        $("#edit_restricted").html("");
        $("#articleTitle").val("");
        $("#articleID").val("0");
        $("#selectedAuthors").html("");
        var myID=<?php echo $myID;?>;$("#authors").val(myID);
        $("#selectedAuthors").append($('<option>', {
                    value: myID,
                    text: $("#registeredAuthors option[value='"+myID+"']").text()
                }));
        $("#articleText").val("");
        $("#editorNote").val("");
        $("#document").val("");
        $("#image").val("");
        $("#contMain").show();
    }
    function aFormLoad(index) {
        $.getJSON( "include/ajax/getArticle.php?id="+index, function( data ) {
            $("#edit_header").html("Úprava článku "//
              +'<a href="article.php?id='+data[0]['ID']+'" target="_preview"><button type="button" class="btn btn-primary mt-2 float-end">Náhled</button></a>');
            $("#edit_restricted").html(((data[0]['Status']==20)?"":'<span style="color:red;">Pozor, článek je zpracováván, editace teď není možná.</span> Lze pouze zaslat redaktorovi novou, neaktivní verzi článku (tlačítko "Upload Document"+"Uložit").'));
            $("#articleTitle").val(data[0]['Title']);
            $("#articleID").val(data[0]['ID']);
            $("#authors").val(data[0]['authors']);
            $("#selectedAuthors").html("");
            $.each(data[0]['authors'].split(','),function(){
                $("#selectedAuthors").append($('<option>', {
                    value: this,
                    text: $("#registeredAuthors option[value='"+this+"']").text()
                }));
            });
            $("#articleText").val(data[0]['Abstract']);
            $("#editorNote").val("");
            $("#document").val("");
            $("#image").val("");
            $("#contMain").show();
        });    
    }
    function aPost() {
      var inField={
            "": "",
            "articleID" : "",
            "edition" : "#edice",
            "articleTitle" : "#articleTitle",
            "authors" : "#selectedAuthors",
            "abstract" : "#articleText",
            "document" : "#document-btn",
            "image" : "#image-btn",
            "note" : "#editorNote"
        };
        $(".alert-danger").removeClass("alert-danger");
        if ($('#document').val()) if (($("#document")[0].files[0].size / 1024)  > 5000) {
            $('#document').addClass("alert-danger");alert("Dokument přesahuje 5MB");return false;}
        if ($('#image').val()) if (($("#image")[0].files[0].size / 1024)  > 1000) {
            $('#image').addClass("alert-danger");alert("Obrázek přesahuje 1MB");return false;}
        var formData = new FormData();
        formData.append("articleID", $('#articleID').val());
        formData.append("edition", $('#edice').val());
        formData.append("articleTitle", $('#articleTitle').val());
        formData.append("authors", $('#authors').val());
        formData.append("abstract", $('#articleText').val());
        formData.append("document", $('#document')[0].files[0]);
        formData.append("image", $('#image')[0].files[0]);
        formData.append("doc_name", $('#document').val());
        formData.append("note", $('#editorNote').val());
        $.ajax({
            url: 'include/ajax/setArticleAuthor.php',  // URL PHP backendového skriptu
            type: 'POST',
            data: formData,
            contentType: false,  // Důležité pro FormData
            processData: false,  // Důležité pro FormData
            success: function(response) {
                d=$.parseJSON(response);
                if (d["status"]==1) {
                    articlesLoad(3,"22,24"); // autor nebo regAutor
                    messagesLoad(2,0);
                    setLayout(1);
                    alert(d["message"]);
                } else {
                    if (inField[d["param"]]!="") {
                        $(inField[d["param"]]).addClass("alert-danger");}
                    alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
                }
            },
            error: function(xhr, status, error) {
                alert("Nepodařilo se odeslat data na server: "+error);
            }
        }
      );
    }
    
    function registerNewAuthor() { //Aleš
        aUserPost("")
    }
    function onUserDone (it) {
    if (it.value==0) {
        aUserEmpty();
        $('#newAuthorModal').modal('hide');
        filterAuthors();
    }
}

</script>
       

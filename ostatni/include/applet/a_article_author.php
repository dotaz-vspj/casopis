<?php ?>
        <h5 class="mb-5" id="edit_header">Vložení/úprava článku</h5>
        <form>
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
                    <button type="button" class="btn btn-primary mt-2">Registrovat neevidovaného autora</button>
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

            <div class="form-buttons">
                <select id="edice" name="edice" style="width: 120px;">
                    <option disabled selected>Žádná dostupná edice</option>
                </select>

                <!-- Custom file input for document -->
                <label class="btn btn-primary" for="document">Upload Document</label>
                <input class="form-control" id="document" name="document" type="file" style="display: none;">

                <!-- Custom file input for image -->
                <label class="btn btn-primary" for="image">Upload Image</label>
                <input class="form-control" id="image" name="image" type="file" style="display: none;">

                <button class="btn btn-success" name="submit" type="submit">Uložit</button>
            </div>
        </form>
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
                '<option value="',e['ID'],'">',e['ID'],':',((e['TitleF']!=null)?e['TitleF']+' ':''),e['FirstName'],' ',e['LastName'],((e['TitleP']!=null)?', '+e['TitleP']:''),"</option>\n");
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
        $("#articleTitle").val("");
        $("#articleID").val("0");
        $("#selectedAuthors").html("");
        var myID=getMyID();$("#authors").val(myID);
        $("#selectedAuthors").append($('<option>', {
                    value: myID,
                    text: $("#registeredAuthors option[value='"+myID+"']").text()
                }));
        $("#articleText").val("");
        $("#editorNote").val("");
        $("#document").val("");
        $("#image").val("");
    }
    function aFormLoad(index) {
        $.getJSON( "include/ajax/getArticle.php?id="+index, function( data ) {
            $("#edit_header").html("Úprava článku ID="+data[0]['ID']+'<a href="article.php?id='+data[0]['ID']+'" target="_preview"><button type="button" class="btn btn-primary mt-2 float-end">Náhled</button></a>');
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
        });    
    }
</script>
       

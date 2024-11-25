    <h5 class="mb-5" id="edit_header">Zpracování Článku</H5>
    <div class="form-group">
        <label for="articleTitle">Název článku</label>
        <input type="text" class="form-control" id="articleTitle" disabled>
        <input type="hidden" id="articleID" name="articleID">
        <label for="articleStatus">Stav článku</label>
        <select class="form-control" id="articleStatus" disabled>
<?php
$sql="SELECT * FROM `RSP_CC_ARTICLE_Stat`";
$result = $conn->query($sql);
while ($st=$result->fetchObject()) {?>
        <option value="<?php echo $st->ID; ?>"><?php echo $st->descr; ?></option>
<?php } ?>
        </select>
        <div id="oppHeader"></div>
    </div>
    <div id="article_catch" class="row" style="display:none;">
        <label for="articleCatch">Převzít článek</label>
        <span style="color:red;">Pozor, článek je zpracováván jinou osobou, přepnutí následujícího voliče a odeslání způsobí násilné převzetí.</span>
        <select class="form-control" id="articleCatch">
            <option value="" disabled selected>--Potvrďte převzetí článku--</option>
            <option value="10,17">Převzít článek</option>
        </select>
    </div>
    <div id="article_accept" class="row" style="display:none;">
        <label for="articleVersion">Aktivní verze článku</label>
        <select class="form-control" id="articleVersion">
        </select>
        <label for="articleAccept">Přijmout článek</label>
        <select class="form-control" id="articleAccept">
            <option value="" disabled selected>--nastavte zvolený postup--</option>
            <option value="12,12">Přijmout článek (->nastavení oponentů)</option>
            <option value="20,16">Vrátit článek k úpravě</option>
            <option value="11,11">Odmítnout článek (nevratné!!!)</option>
        </select>
    </div>
    <div id="article_publish" class="row" style="display:none;">
        <label for="articlePublish">Přijmout článek</label>
        <select class="form-control" id="articlePublish">
            <option value="" disabled selected>--nastavte zvolený postup--</option>
            <option value="5,15">Publikovat článek</option>
            <option value="10,21">Vrátit článek do redakce</option>
            <option value="11,11">Odmítnout článek (nevratné!!!)</option>
        </select>
    </div>
    <div id="select_opponents" class="row" style="display:none;">
                    <div class="form-group author-selectors">
                <!-- Autoři článku -->
                <div class="w-50">
                    <label for="selectedOpps">Oponenti článku</label>
                    <select multiple class="form-control" id="selectedOpps" size="5">
                    </select>
                    <input type="hidden" id="opponents" name="opponents">
                </div>

                <!-- Šipky pro přesouvání autorů -->
                <div class="arrows">
                    <button type="button" class="btn btn-outline-secondary" onclick="opponentAdd();">&larr;</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="opponentRemove();">&rarr;</button>
                </div>

                <!-- Registrovaní autoři -->
                <div class="w-50">
                    <label for="registeredOpps">Registrované osoby</label>
                    <select class="form-control" id="registeredOpps">
                        <option disabled selected>Selhalo načtení osob</option>
                    </select>
                </div>
            </div>

    </div>
    <div class="form-group">
        <label for="editorNote">Poznámka události</label>
        <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte poznámku k události"></textarea>
    </div>

    <div class="form-buttons">
        <button class="btn btn-success" onclick="aPost()">Odeslat</button>
    </div>
<script>
    function editionsLoad(type,index){
        $.getJSON( "include/ajax/getEditions.php?typ="+type+"&id="+index, function( data ) {
            var l_html="<option value=\"-2\" selected>Všechny v neuzavřeném řízení</option>\n"+
                       "<option value=\"-1\">Nezařazené k edici</option>\n";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<option value="',e['ID'],'">',e['ID'],':',e['Title'],"</option>\n");
            });
            $( "#articlesFilter" ).html( l_html );
        });    
    }
    function versionsLoad(type, index) {
        $.getJSON( "include/ajax/getVersions.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<option value="',e['ID'],'">',e['ID'],':',e['Document']," [",e['Created'],"]</option>\n");
            });
            $( "#articleVersion" ).html( l_html );
        });    

    }
    function hidetabs(){
        $("#article_catch").hide();
        $("#article_accept").hide();
        $("#article_publish").hide();
        $("#select_opponents").hide();
        $("#articleAccept").val("");
        $("#articlePublish").val("");
    }
    function oppsLoad(type,index){
        $.getJSON( "include/ajax/getUsers.php?typ="+type+"&id="+index, function( data ) {
            var l_html="<option value=\"0\" disabled selected>Vyberte oponenta</option>\n";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<option value="',e['ID'],'">',e['ID'],':',((e['TitleF']!=null)?e['TitleF']+' ':''),e['FirstName'],' ',e['LastName'],((e['TitleP']!=null)?', '+e['TitleP']:''),"</option>\n");
            });
            $( "#registeredOpps" ).html( l_html );
        });    
    }
    function opponentRemove() {
        $("#selectedOpps :selected").remove();
        var arr=[];$("#selectedOpps option").each(function(){arr.push($(this).val());});
        $("#opponents").val(arr);
    }
    function opponentAdd() {
        var authorAdd= $( "#registeredOpps :selected" );
        if ((authorAdd.val()!="0")&&($.inArray(authorAdd.val(),$("#opponents").val().split(','))==-1)){
            $("#selectedOpps").append($('<option>', {
                value: authorAdd.val(),
                text: authorAdd.text()
            }));
        $("#registeredOpps").val("0");
        }
        var arr=[];$("#selectedOpps option").each(function(){arr.push($(this).val());});
        $("#opponents").val(arr);
    }
    function aFormLoad(index) {
        $.getJSON( "include/ajax/getArticle.php?id="+index, function( data ) {
            $("#edit_header").html("Zpracování článku ID="+data[0]['ID']+'<a href="article.php?id='+data[0]['ID']+'" target="_preview"><button type="button" class="btn btn-primary mt-2 float-end">Náhled</button></a>');
            $("#articleTitle").val(data[0]['Title']);
            $("#articleID").val(data[0]['ID']);
            $("#opponents").val(data[0]['opponents']);
            $("#selectedOpps").html("");
            if (data[0]['opponents']) 
              $.each(data[0]['opponents'].split(','),function(){
                $("#selectedOpps").append($('<option>', {
                    value: this,
                    text: $("#registeredOpps option[value='"+this+"']").text()
                }));
            });
            $("#editorNote").val("");
        });    
        versionsLoad(0,index);
        $.getJSON( "include/ajax/getOppSummary.php?id="+index, function( data ) {
            $("#oppHeader").html('Stav recenzí: Přiděleno: '+data["sum"]+', přijato: '+data["acc"]+', schváleno: '+data["done"]);
            
         });    
    }
    function aPost() {
      const Choice=(($("#articleStatus").val()=="10")?$("#articleAccept").val():(($("#articleStatus").val()=="40")?$("#articlePublish").val():$("#articleCatch").val()));
      if (($("#articleStatus").val()=="12")||(Choice&&(Choice!=""))) 
      $.post("include/ajax/setArticleRedactor.php",
        {
            articleID: $("#articleID").val(),
            action: $("#articleStatus").val(),
            status: Choice,
            version: $("#articleVersion").val(),
            opponents: $("#opponents").val(),
            note: $("#editorNote").val()
        },
        function(data, status){
            d=$.parseJSON(data);
            if ((status="success")&&(d["status"]==1)) {
                articlesLoad(2,$("#articlesFilter").val()); // obnov seznam článků
                articleClick($("#articleID").val(),d["param"]);
                alert(d["message"]);
            } else {
                alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
            }
        }
      );
    }
</script>
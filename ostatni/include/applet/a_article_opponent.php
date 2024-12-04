    <h5 class="mb-5" id="edit_header">Zpracování Článku</H5>
    <div class="form-group">
        <label for="articleTitle">Název článku</label>
        <input type="text" class="form-control" id="articleTitle" disabled>
        <input type="hidden" id="articleID" name="articleID">
    </div>
    <div id="opp_accept" class="row" style="display:none;">
        <input type="hidden" id="submitID" name="submitID">
        <label for="articleAccept">Přijmout oponenturu</label>
        <select class="form-control" id="articleAccept">
            <option value="" disabled selected>--nastavte zvolený postup--</option>
            <option value="31,32">Přijmout oponenturu</option>
            <option value="13,30">Odmítnout oponenturu</option>
        </select>
    </div>
    <div id="opp_submit" class="row" style="display:block;">
        <h5>Recenze článku</h5>
        <div class="row form-group">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="ratingRelevance" class="form-label">Aktuálnost, zajímavost a přínosnost</label>
                    <select class="form-select" id="ratingRelevance" required>
                        <option value="" disabled selected>Vyberte hodnocení</option>
                        <option value="1">1 (nejlepší)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 (nejhorší)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ratingOriginality" class="form-label">Originalita</label>
                    <select class="form-select" id="ratingOriginality" required>
                        <option value="" disabled selected>Vyberte hodnocení</option>
                        <option value="1">1 (nejlepší)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 (nejhorší)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="ratingExpertise" class="form-label">Odborná úroveň</label>
                    <select class="form-select" id="ratingExpertise" required>
                        <option value="" disabled selected>Vyberte hodnocení</option>
                        <option value="1">1 (nejlepší)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 (nejhorší)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ratingLanguage" class="form-label">Jazyková a stylistická úroveň</label>
                    <select class="form-select" id="ratingLanguage" required>
                        <option value="" disabled selected>Vyberte hodnocení</option>
                        <option value="1">1 (nejlepší)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 (nejhorší)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="form-group">
                <label for="recenze">Detailní slovní hodnocení</label>
                <textarea class="form-control" id="recenze" rows="2" placeholder="Zadejte detail recenze"></textarea>
            </div>
            <div class="mb-3">
                <label for="ratingOverall" class="form-label">Celkový verdikt</label>
                <select class="form-select" id="ratingOverall" required>
                    <option value="" disabled selected>Vyberte hodnocení</option>
                    <option value="1">Přijímám bez výhrad</option>
                    <option value="2">Přijímám s výhradami (nepožaduji opravy k revizi)</option>
                    <option value="3">Vracím k doplnění (požaduji opravy na novou recenzi)</option>
                    <option value="4">Zamítám</option>
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
    var formStatus=0;
    var articleStatus=0;

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
    function hidetabs(){
        $("#opp_accept").hide();
        $("#opp_submit").hide();
        $("#articleAccept").val("");
        formStatus=0;
    }
    function aFormLoad(index) {
        $("#articleID").val(index);
        $("#editorNote").val("");
        $.getJSON( "include/ajax/getArticle.php?id="+index, function( data ) {
            $("#edit_header").html("Zpracování článku ID="+data[0]['ID']+'<a href="article.php?id='+data[0]['ID']+'" target="_preview"><button type="button" class="btn btn-primary mt-2 float-end">Náhled</button></a>');
            $("#articleTitle").val(data[0]['Title']);
        });
        formStatus=0; //neposíláme nic
        if ([12,30,31].includes(articleStatus)) {
            $.getJSON( "include/ajax/getMessages.php?typ=5&id="+index, function( data ) {
                formStatus=1; //posíláme stav
                if (data[0]) {  //pokud s článkem pracoval, a naposled přijal nebo zpracoval recenzi...
                    formStatus=2; // asi posíláme recenzi
                    if (data[0]["Type"] == 32) {
                        $("#submitID").val(0);    
                        $("#ratingRelevance").val("");    
                        $("#ratingOriginality").val("");    
                        $("#ratingExpertise").val("");    
                        $("#ratingLanguage").val("");    
                        $("#ratingOverall").val("");    
                        $("#recenze").val("");
                    } else if ([31,34,35].includes(data[0]["Type"])) {
                        $("#submitID").val(data[0]["ID"]);    
                        rng=JSON.parse(data[0]["Data"]);
                        $("#ratingRelevance").val(rng["Relevance"]);    
                        $("#ratingOriginality").val(rng["Originality"]);    
                        $("#ratingExpertise").val(rng["Expertise"]);    
                        $("#ratingLanguage").val(rng["Language"]);    
                        $("#ratingOverall").val(rng["Overall"]);    
                        $("#recenze").val(rng["Msg"].replace(/u(0[01][\dA-F]{2})/gi, function(match, code) {return String.fromCharCode(parseInt(code, 16));}));
                    } else {    // pokud na to "sáhl blbě"
                        formStatus=1; // tak ne, posíláme stav
                    }
                }
                if (formStatus==2) $("#opp_submit").show();
                else  $("#opp_accept").show();

            });
        }
    }
    function aPost() {
        var isOK=false;
        if (formStatus==1) isOK=($("#articleAccept").val()!="");
        var DATA={};
        if (formStatus==2) {
            DATA={ 
                Relevance : $("#ratingRelevance").val(),    
                Originality : $("#ratingOriginality").val(),   
                Expertise : $("#ratingExpertise").val(),  
                Language : $("#ratingLanguage").val(),   
                Overall : $("#ratingOverall").val(),   
                Msg : $("#recenze").val()};
            if (!DATA['Relevance'] || !DATA['Originality'] || !DATA['Expertise'] || !DATA['Language']|| !DATA['Overall']) {
                alert("Prosím ohodnoťte všechny kategorie.");
                return;
            }    
            isOK=true;
        }

      if (isOK) 
      $.post("include/ajax/setArticleOpponent.php",
        {
            articleID: $("#articleID").val(),
            action: formStatus,
            status: $("#articleAccept").val(),
            data: DATA,
            note: $("#editorNote").val()
        },
        function(data, status){
            d=$.parseJSON(data);
            if ((status="success")&&(d["status"]==1)) {
                articlesLoad(1,"21"); // obnov seznam článků
                articleClick($("#articleID").val(),d["param"]);
                alert("Stav nastaven.");
            } else {
                alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
            }
        }
      );
    }
</script>
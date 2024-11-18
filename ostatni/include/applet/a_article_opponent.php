    <h5 class="mb-5" id="edit_header">Zpracování Článku</H5>
    <div class="form-group">
        <label for="articleTitle">Název článku</label>
        <input type="text" class="form-control" id="articleTitle" disabled>
        <input type="hidden" id="articleID" name="articleID">
    </div>
    <div id="article_accept" class="row" style="display:none;">
        <label for="articleAccept">Přijmout oponenturu</label>
        <select class="form-control" id="articleAccept">
            <option value="" disabled selected>--nastavte zvolený postup--</option>
            <option value="7,12">Přijmout oponenturu</option>
            <option value="4,13">Odmítnout oponenturu</option>
        </select>
    </div>
    <div id="maketar" class="row" style="display:block;">
    <H1>MAKETA oponent</H1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed convallis magna eu sem. Sed ac dolor sit amet purus malesuada congue. In convallis. Etiam egestas wisi a erat. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Et harum quidem rerum facilis est et expedita distinctio. Donec vitae arcu. Maecenas libero. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Curabitur bibendum justo non orci. Praesent in mauris eu tortor porttitor accumsan. Fusce suscipit libero eget elit. Curabitur sagittis hendrerit ante.</p>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum fermentum tortor id mi. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Integer imperdiet lectus quis justo. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas libero. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean id metus id velit ullamcorper pulvinar. Maecenas lorem. Aliquam erat volutpat. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Integer malesuada. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Proin in tellus sit amet nibh dignissim sagittis. Curabitur sagittis hendrerit ante. Aliquam in lorem sit amet leo accumsan lacinia. Etiam dictum tincidunt diam. </p>
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
    function hidetabs(){
        $("#article_accept").hide();
        $("#maketar").hide();
        $("#articleAccept").val("");
    }
    function aFormLoad(index) {
        $.getJSON( "include/ajax/getArticle.php?id="+index, function( data ) {
            $("#edit_header").html("Zpracování článku ID="+data[0]['ID']+'<a href="article.php?id='+data[0]['ID']+'" target="_preview"><button type="button" class="btn btn-primary mt-2 float-end">Náhled</button></a>');
            $("#articleTitle").val(data[0]['Title']);
            $("#articleID").val(data[0]['ID']);
            $("#editorNote").val("");
        });    
    }
    function aPost() {
      var isOK=false;
      if (ArticleStatus==4) isOK=($("#articleAccept").val()!="");
      
      if (isOK) 
      $.post("include/ajax/setArticleOpponent.php",
        {
            articleID: $("#articleID").val(),
            action: ArticleStatus,
            status: $("#articleAccept").val(),
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
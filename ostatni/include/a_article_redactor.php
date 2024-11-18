    <h5>Článek ID &nbsp;<input type="text" disabled id="articleID" name="articleID"></H5>
    <div id="article_accept" class="row" style="display:none;">
        <label for="articleAccept">Přijmout článek</label>
        <select class="form-control" id="articleAccept">
            <option value="" disabled selected>--nastavte zvolený postup--</option>
            <option value="2,6">Přijmout článek</option>
            <option value="3,7">Odmítnout článek</option>
        </select>
    </div>
    <div id="maketar" class="row" style="display:block;">
    <H1>MAKETA redaktor</H1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed convallis magna eu sem. Sed ac dolor sit amet purus malesuada congue. In convallis. Etiam egestas wisi a erat. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Et harum quidem rerum facilis est et expedita distinctio. Donec vitae arcu. Maecenas libero. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Curabitur bibendum justo non orci. Praesent in mauris eu tortor porttitor accumsan. Fusce suscipit libero eget elit. Curabitur sagittis hendrerit ante.</p>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum fermentum tortor id mi. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Integer imperdiet lectus quis justo. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas libero. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean id metus id velit ullamcorper pulvinar. Maecenas lorem. Aliquam erat volutpat. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Integer malesuada. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Proin in tellus sit amet nibh dignissim sagittis. Curabitur sagittis hendrerit ante. Aliquam in lorem sit amet leo accumsan lacinia. Etiam dictum tincidunt diam. </p>
    </div>
    <div class="form-group">
        <label for="editorNote">Poznámka pro autora</label>
        <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte poznámku pro autora"></textarea>
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
    function aPost(status) {
      if ($("#articleAccept").val()!="")
      $.post("include/ajax/setArticleRedactor.php",
        {
            articleID: $("#articleID").val(),
            action: "setstatus",
            value: $("#articleAccept").val(),
            note: $("#editorNote").val()
        },
        function(data, status){
            d=$.parseJSON(data);
            if ((status="success")&&(d["status"]==1)) {
                articlesLoad(2,$("#articlesFilter").val()); // obnov seznam článků
                messagesLoad(0,0);
                setLayout(1);
                alert("Stav nastaven.");
            } else {
                alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
            }
        }
      );
    }
</script>
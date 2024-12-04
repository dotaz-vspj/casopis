<<<<<<< HEAD
<!-- Modal by AI -->
<div class="modal fade" id="opponentModal" tabindex="-1" role="dialog" aria-labelledby="opponentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-height: auto; border:solid; border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="opponentModalLabel">Detaily Oponentury</h5>
                <button type="button" class="btn-close" onclick="$('#opponentModal').removeClass('show').css('display', 'none').attr('aria-hidden', 'true').removeAttr('aria-modal');" aria-label="Zavřít"></button>
            </div>
            <div class="modal-body">
                <p id="opponentDetails">Načítám...</p>
            </div>
        </div>
    </div>
</div>

<div class="modal-content" id="messageListContainer" style="min-height: 100%;">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Zprávy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="setLayout(3);"></button>
    </div>
    <div class="modal-body" id="messageList">
        <p class="no-messages">Žádné aktivní zprávy</p>
    </div>
</div>

<script>
    function messagesLoad(type,index){
        $.getJSON( "include/ajax/getMessages.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html += `
                <div class="list-group-item" data-id="${e['ID']}" ${((e['Message'])?'onclick="toggleDetails(this)"':"")} ${((e['Data'])?"ondblclick=\"messageClick("+e['ID']+","+e['Article']+","+e['Type']+")\"":"")}>
                        <div class="message-header">
                            <div class="col d-flex justify-content-between flex-wrap">
                            <div class="box">${e['Datum'] || "Datum neznámé"} - ${e['Author'] || "Autor neznámý"}</div>
                            <div class="box"> ${e['TypeText'] || "Neurčeno"} ${((e['Article'])?"- (čl."+e['Article']+") ":"")}&nbsp; </div></div>
                            <div style="widtht:3em">${((e['Message'])?'&#9660':"")}${((e['Data'])?'&#9650':"")}</div>
                        </div>
                        <div class="message-details">
                            <div> ${e['Message'] || ""}</div>
                        </div>
                    </div>
                `;
            });
        document.getElementById("messageList").innerHTML = l_html;
        });
    }
    function toggleDetails(element) {
        element.classList.toggle("expanded");
    }
    function opponentureLoad(opponentId) {                
        // AJAX request pro získání oponentury podle ID
        $.ajax({
            url: "include/ajax/getOpponenture.php",
            method: "GET",
            data: { id: opponentId },
            success: function(response) {
                // Předpokládám, že v odpovědi je JSON s detaily
                var data = JSON.parse(response);

                // Zobrazit detaily oponentury v modálním okně
                var details = "<strong>Relevance:</strong> " + data.Relevance + "<br>" +
                              "<strong>Originality:</strong> " + data.Originality + "<br>" +
                              "<strong>Expertise:</strong> " + data.Expertise + "<br>" +
                              "<strong>Language:</strong> " + data.Language + "<br>" +
                              "<strong>Overall:</strong> " + data.Overall + "<br>" +
                              "<strong>Message:</strong> " + data.Msg.replace(/u(0[01][\dA-F]{2})/gi, function(match, code) {return String.fromCharCode(parseInt(code, 16));})+
                              ((data.doc!=null)?'<a href="include/ajax/getDocument.php?typ=o&id='+data.id+'">'+
                              '<img src="<?php echo "{$img_dir}";?>download.png" height=50 alt="Soubor ke stažení"></a>':'');
                
                    $("#opponentDetails").html(details);

                // Otevření modálního okna
                $('#opponentModal').addClass('show').css('display', 'block').attr('aria-modal', 'true').removeAttr('aria-hidden').show();
//                $('body').append('<div class="modal-backdrop fade show style="z-index: 10;"></div>');

                
            },
            error: function() {
                alert("Chyba při načítání oponentury."+status);
            }
        });
    }
    function opponentListLoad(id) {                
        // AJAX request pro získání oponentury podle ID
        $.getJSON("include/ajax/getMessages.php?id="+id, function( data ) {
          $.getJSON("include/ajax/getUsers.php?typ=4&id="+JSON.parse(data[0]["Data"]).join(","), function( data ) {
            // Zobrazit detaily oponentury v modálním okně
            var l_html="<H5>Seznam oponentů po akci:</h5>\n";
            var opps=$("#opponents").val();
            $.each(data, function(i,e) {if (e) l_html += `
                <li class="list-group-item" data-id="${e['ID']}" >
                    <span style="${((opps)?"background-color:"+((opps.split(',').includes(String(e['ID'])))?"lightgreen; ":"red; "):"")}display: inline-block; text-align:center; width:4ch;">${e['ID']}</span> &nbsp;
                    ${e['LastName']}, ${e['FirstName']}</li>
                `;
            });
            $("#opponentDetails").html(l_html);

            // Otevření modálního okna
            $('#opponentModal').addClass('show').css('display', 'block').attr('aria-modal', 'true').removeAttr('aria-hidden').show();
        });
      });
    }
</script>
=======
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Zprávy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="setLayout(3);"></button>
            </div>
            <div class="modal-body" id="messageList">
                Žádné aktivní zprávy
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="opponentModal" tabindex="-1" role="dialog" aria-labelledby="opponentModalLabel" aria-hidden="true" style="height:600px; padding-top:200px; ">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
                        <h5 class="modal-title" id="opponentModalLabel">Detaily Oponentury</h5>
                    </div>
                    <div class="modal-body">
                        <p id="opponentDetails">Načítám...</p>
                    </div>
                </div>
            </div>
        </div> 
<script>
    function messagesLoad(type,index){
        $.getJSON( "include/ajax/getMessages.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<p class="list-group-item" data-id="',e['ID'],'" ondblclick="messageClick(',e['ID'],",'",e['Article'],"',",e['Type'],');">',e['ID'],'(',e['TypeText'],',',e['Article'],'):',e['Message'],"</p>\n");
            });
            $( "#messageList" ).html( l_html );
        });    
    }
    function opponentureLoad(opponentId) {                
        // AJAX request pro získání oponentury podle ID
        $.ajax({
            url: "include/ajax/getOpponenture.php",
            method: "GET",
            data: { id: opponentId },
            success: function(response) {
                // Předpokládám, že v odpovědi je JSON s detaily
                var data = JSON.parse(response);

                // Zobrazit detaily oponentury v modálním okně
                var details = "<strong>Relevance:</strong> " + data.Relevance + "<br>" +
                              "<strong>Originality:</strong> " + data.Originality + "<br>" +
                              "<strong>Expertise:</strong> " + data.Expertise + "<br>" +
                              "<strong>Language:</strong> " + data.Language + "<br>" +
                              "<strong>Overall:</strong> " + data.Overall + "<br>" +
                              "<strong>Message:</strong> " + data.Msg.replace(/u(0[01][\dA-F]{2})/gi, function(match, code) {return String.fromCharCode(parseInt(code, 16));});
                $("#opponentDetails").html(details);

                // Otevření modálního okna
                $("#opponentModal").modal('show');
            },
            error: function() {
                alert("Chyba při načítání oponentury."+status);
            }
        });
    }
</script>
>>>>>>> 609e36f10bc9432c73774adb86c5e325502420be

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

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Zprávy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="setLayout(3);"></button>
            </div>
            <div class="modal-body" id="messageList">
                Zde budou zprávy
            </div>
        </div>
<script>
    function messagesLoad(type,index){
        $.getJSON( "include/ajax/getMessages.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<p class="list-group-item" data-id="',e['ID'],' ondblclick="messageClick(',e['ID'],",'",e['Article'],"',",e['Type'],'">',e['ID'],'(',e['TypeText'],',',e['Article'],'):',e['Message'],"</p>\n");
            });
            $( "#messageList" ).html( l_html );
        });    
    }
</script>

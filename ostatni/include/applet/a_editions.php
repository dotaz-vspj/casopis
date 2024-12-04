                    <ul class="list-unstyled list-group-flush list-group" id="articleList">
                    </ul>
<script>
    function editionsLoad(type,index){
        $.getJSON( "include/ajax/getEditions.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<li class="list-group-item" data-id=',e['ID'],' onclick="editionClick(',e['ID'],',0);"><span style="display: inline-block; text-align:center; width:4ch;">',e['ID'],'</span>:',e['Title'],"</li>\n");
            });
            $( "#articleList" ).html( l_html );
        });    
    }
</script>

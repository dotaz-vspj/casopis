                    <ul class="list-unstyled list-group-flush list-group" id="articleList">
                    </ul>
<script>
    function articlesLoad(type,index){
        $.getJSON( "include/ajax/getArticles.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<li class="list-group-item" data-id=',e['ID'],' onclick="articleClick(',e['ID'],',',e['Status'],');"><span style="background-color:',e['color'],'; display: inline-block; text-align:center; width:4ch;">',e['ID'],'</span>:',e['Title'],"</li>\n");
            });
            $( "#articleList" ).html( l_html );
        });    
    }
</script>

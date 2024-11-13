                    <h5 class="mb-5">Moje články</h5>
                    <ul class="list-unstyled list-group-flush list-group" id="articleList">
                    </ul>
<script>
    function articlesLoad(type,index){
        $.getJSON( "include/ajax/getArticles.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<li class="list-group-item" data-id=',e['ID'],' ondblclick="articleClick(',e['ID'],',0);">',e['ID'],':',e['Title'],"</li>\n");
            });
            $( "#articleList" ).html( l_html );
        });    
    }
</script>

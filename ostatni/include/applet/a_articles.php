                    <ul class="list-unstyled list-group-flush list-group" id="articleList">
                    </ul>
                    <select id="legend" onchange="passive();" style="font-size: 0.6em; ">
                        <option value="0" selected>Legenda</option>
<?php $sql="select * from RSP_CC_ARTICLE_Stat";
$result = $conn->query($sql);
while ($CC=$result->fetchObject()) {
?>
                        <option value="<?php echo $CC->ID;?>" style="background-color: <?php echo $CC->color;?>; "><?php echo $CC->descr;?></option>
<?php } ?>
                    </select>
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
    function passive() {
    if ($("#legend").val()!="0") $("#legend").val("0").change();
    }
    
</script>

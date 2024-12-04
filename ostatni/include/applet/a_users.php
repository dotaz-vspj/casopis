                    <ul class="list-unstyled list-group-flush list-group" id="userList">
                    </ul>
<script>
    function usersLoad(type,index){
        $.getJSON( "include/ajax/getUsers.php?typ="+type+"&id="+index, function( data ) {
            var l_html="";
            $.each(data, function(i,e) {if (e) l_html = l_html.concat(
                '<li class="list-group-item" data-id=',e['ID'],' onclick="userClick(',e['ID'],',',e['Func'],');"><span style="background-color:',((e['Active']==0)?"red":"lightgreen"),'; display: inline-block; text-align:center; width:4ch;">',e['ID'],'</span>: ',e['LastName'],', ',e['FirstName'],' (',((e['Login'])?e['Login']:' --- '),")</li>\n");
            });
            $( "#userList" ).html( l_html );
        });    
    }
</script>

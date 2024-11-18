<?php 
// Template Administračního rozhraní Verse 2.0
// Plné menu, kliknutí předáváno pomocí "intuitivních" parametrů
// Seznam článků bez hlavičky a s upravenými barvami podle stavu

include 'include/session_open.php'; ?>
<?php include 'include/db.php'; 
$scriptName="";
$myFunc=50; //not registered
if ($myID!=0) {$sql = "SELECT Func from `RSP_USER` U where ID=".$myID;
    $result = $conn->query($sql);
    $myFunc = $result->fetch()[0];}
if (($myFunc==50)||($myFunc==23)) {Header("location:index.php");die;}    
?>
<?php include 'include/header.php'; ?>

<div class="row w-100" style="min-height: 100vh; margin:0 auto 0 auto; padding-top: 90px; ">
<!-- Menu -->
<div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px; ">
<?php include 'include/applet/a_menu.php'; ?>
</div>

<!-- List -->
<div class="pt-3 overflow-hidden" id="list-out"><div style="width:800px; ">
                    <h5 class="mb-5">Moje články</h5>
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
        <H1>MAKETA administrace vydání</H1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed convallis magna eu sem. Sed ac dolor sit amet purus malesuada congue. In convallis. Etiam egestas wisi a erat. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Et harum quidem rerum facilis est et expedita distinctio. Donec vitae arcu. Maecenas libero. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Curabitur bibendum justo non orci. Praesent in mauris eu tortor porttitor accumsan. Fusce suscipit libero eget elit. Curabitur sagittis hendrerit ante.</p>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum fermentum tortor id mi. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Integer imperdiet lectus quis justo. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas libero. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean id metus id velit ullamcorper pulvinar. Maecenas lorem. Aliquam erat volutpat. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Integer malesuada. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Proin in tellus sit amet nibh dignissim sagittis. Curabitur sagittis hendrerit ante. Aliquam in lorem sit amet leo accumsan lacinia. Etiam dictum tincidunt diam. </p>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div>
<script>
    var style=-1;
    var styles={0:{  //1-3-6-2
            "list-out":["col-sm-3"],
            "main-out":["col"],
            "messages-out":["col-sm-2","mx-3","border","rounded-3"]},
                1:{  //1-3-0-6
            "list-out":["col"],
            "main-out":[],
            "messages-out":["col-sm-6","mx-3","border","rounded-3"]},
                2:{  //1-3-(6)-4
            "list-out":["col-sm-3"],
            "main-out":["col-sm-6","bg-primary"],
            "messages-out":["overlayed","col-sm-4","mx-3","bg-dark","border-double","border-3","rounded-2"]},
                3:{  //1-3-8-0
            "list-out":["col-sm-3"],
            "main-out":["col","bg-primary"],
            "messages-out":[]}};

    $( document ).ready(function () {
    articlesLoad(0,0);
    messagesLoad(0,0);
    setLayout(3);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrAdm") {window.location.replace('user_admin.php');}
    if (index=="EdiAdm") {window.location.replace('edition_admin.php');}
    if (index=="ArtRed") {window.location.replace('article_redactor.php');}
    if (index=="ArtOpp") {window.location.replace('article_opponent.php');}
    if (index=="ArtNew") {window.location.replace('article_author.php');}
    if (index=="ArtAut") {window.location.replace('article_author.php');}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function articleClick(index,version){
    console.log('Article:'+index+','+version);
    messagesLoad(1,index);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
    setLayout(index % 3);
};
function setLayout(mode) {
    if (style!=-1) {
        Object.keys(styles[style]).forEach(key => {
           styles[style][key].forEach(value => {
           $("#"+key).removeClass(value); 
           });
        });
    }
    style=mode;
    Object.keys(styles[style]).forEach(key => {
       $("#"+key).css("display",((styles[style][key].length==0)?"none":"block"));
       styles[style][key].forEach(value => {
       $("#"+key).addClass(value); 
       });
    });
}
function condLayout(cond,mode){
    if (style==cond) {setLayout(mode);return true;}
    }
</script>


<?php include 'include/footer.php'; ?>
    
<?php 
// Vázáno na Administrační rozhraní Verse 2.0
// funkční až na upload
include 'include/session_open.php'; ?>
<?php include 'include/db.php';
$scriptName="ArticleAuthor";
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
<?php include 'include/applet/a_article_author.php'; ?>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div>
<script>
    var style=-1;
    var styles={0:{
            "list-out":["col-sm-3"],
            "main-out":["col"],
            "messages-out":["col-sm-2","mx-3","border","rounded-3"]},
                1:{
            "list-out":["col"],
            "main-out":[],
            "messages-out":["col-sm-6","mx-3","border","rounded-3"]},
                2:{
            "list-out":["col-sm-3"],
            "main-out":["col-sm-6","bg-primary"],
            "messages-out":["overlayed","col-sm-4","mx-3","bg-dark","border-double","border-3","rounded-2"]},
                3:{
            "list-out":["col-sm-3"],
            "main-out":["col","bg-primary"],
            "messages-out":[]}};

    $( document ).ready(function () { 
    articlesLoad(3,"22,24"); // autor nebo regAutor nebo creator
    messagesLoad(2,0);
    editionsLoad(1,0); // nepublikované
    authorsLoad(1,0);  // Jen neadminy
    setLayout(1);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrAdm") {window.location.replace('user_admin.php');}
    if (index=="EdiAdm") {window.location.replace('edition_admin.php');}
    if (index=="ArtRed") {window.location.replace('article_redactor.php');}
    if (index=="ArtOpp") {window.location.replace('article_opponent.php');}
    if (index=="ArtNew") {aFormEmpty();condLayout(1,3);condLayout(2,3);}
    if (index=="ArtAut") {messagesLoad(2,0);setLayout(1);}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function articleClick(index,version){
    console.log('Article:'+index+','+version);
    messagesLoad(2,index);
    aFormLoad(index);
    condLayout(1,0);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
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
function getMyID() {    
    var jqXHR = $.ajax({
        url: "include/ajax/getMyID.php",
        type: 'GET',
        async: false,
    });
    return jqXHR.responseText;
}
</script>

<?php include 'include/footer.php'; ?>
    
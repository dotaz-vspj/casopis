<?php 
// Vázáno na Administrační rozhraní Verse 2.0
// funkční až na upload
include 'include/session_open.php'; ?>
<?php $scriptName="ArticleAuthor";
if ($myFunc>22) {Header("location:index.php");die;}    
?>
<?php include 'include/header.php'; ?>

<div  id="tt-application">
<div  class="tt-row">
<!-- Menu -->
<div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px; ">
<?php include 'include/applet/a_menu.php'; ?>
</div>

<!-- List -->
<div class="pt-3" id="list-out"><div style="width:800px; ">
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

</div></div>
<script>
    $( document ).ready(function () { 
    articlesLoad(3,"22,24"); // autor nebo regAutor nebo creator
    messagesLoad(2,0);
    editionsLoad(1,0); // nepublikované
    authorsLoad(1,0);  // Jen neadminy
    setLayout(2);
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
    
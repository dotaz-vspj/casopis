<?php 
// Template Administračního rozhraní Verse 2.0
// Plné menu, kliknutí předáváno pomocí "intuitivních" parametrů
// Seznam článků bez hlavičky a s upravenými barvami podle stavu
include 'include/session_open.php'; ?>
<?php $scriptName="ArticleOpponent";
if ($myFunc>21) {Header("location:index.php");die;}    
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
                    <h5 class="mb-5">Články k oponentuře</h5>
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
<?php include 'include/applet/a_article_opponent.php'; ?>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
    $( document ).ready(function () {
    articlesLoad(1,"21"); //opponent
    messagesLoad(3,0);
    setLayout(1);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrAdm") {window.location.replace('user_admin.php');}
    if (index=="EdiAdm") {window.location.replace('edition_admin.php');}
    if (index=="ArtRed") {window.location.replace('article_redactor.php');}
    if (index=="ArtOpp") {}
    if (index=="ArtNew") {window.location.replace('article_author.php');}
    if (index=="ArtAut") {window.location.replace('article_author.php');}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function articleClick(index,version){
    articleStatus=parseInt(version);
    console.log('Article:'+index+','+version);
    messagesLoad(3,index);
    hidetabs();
    aFormLoad(index);
    setLayout(0);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
};
</script>


<?php include 'include/footer.php'; ?>
    
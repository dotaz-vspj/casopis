<?php 
// Template Administračního rozhraní Verse 2.0
// Plné menu, kliknutí předáváno pomocí "intuitivních" parametrů
// Seznam článků bez hlavičky a s upravenými barvami podle stavu
include 'include/session_open.php'; ?>
<?php $scriptName="ArticleRedactor";
if ($myFunc>=20) {Header("location:index.php");die;}    
?>
<?php include 'include/header.php'; ?>

<div  id="tt-application">
<div  class="tt-row">
<!-- Menu -->
<div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px; ">
<?php include 'include/applet/a_menu.php'; ?>
</div>

<!-- List -->
<div class="pt-3 overflow-hidden" id="list-out"><div style="width:800px; ">
                    <h5 class="mb-5">Redakce článků</h5>
                    <label for="articlesFilter">Vybrat články</label>
                    <select class="form-control" id="articlesFilter" onchange="articlesLoad(2,this.value);">
                        <option value="-2" selected>Všechny v neuzavřeném řízení</option>
                        <option value="-1">Nezařazené k edici</option>
                    </select>
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
<?php include 'include/applet/a_article_redactor.php'; ?>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
    $( document ).ready(function () {
    editionsLoad(0,0);
    oppsLoad(3,0);
    articlesLoad(2,-2);
    messagesLoad(1,0);
    setLayout(1);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrAdm") {window.location.replace('user_admin.php');}
    if (index=="EdiAdm") {window.location.replace('edition_admin.php');}
    if (index=="ArtRed") {}
    if (index=="ArtOpp") {window.location.replace('article_opponent.php');}
    if (index=="ArtNew") {window.location.replace('article_author.php');}
    if (index=="ArtAut") {window.location.replace('article_author.php');}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function articleClick(index,version){
    console.log('Article:'+index+','+version);
    messagesLoad(1,index);
    hidetabs();
    $("#articleStatus").val(version);
    aFormLoad(index);
    if (version==10) $("#article_accept").show();
    else if (version==12) $("#select_opponents").show();
    else if (version==40) $("#article_publish").show();
    else $("#article_catch").show();
    condLayout(1,0);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
    if ([31,34,35].includes(eventtype)) opponentureLoad(index);
};
</script>


<?php include 'include/footer.php'; ?>
    
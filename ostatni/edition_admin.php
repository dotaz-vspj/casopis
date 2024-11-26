<?php 
// Template Administračního rozhraní Verse 2.0
// Plné menu, kliknutí předáváno pomocí "intuitivních" parametrů
// Seznam článků bez hlavičky a s upravenými barvami podle stavu
include 'include/session_open.php'; ?>
<?php $scriptName="edition_admin";
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
<div class="pt-3" id="list-out"><div style="width:800px; ">
        <div class="row"><div class="col-md-4">            
        <h5 class="mb-5">Vydání</h5>
        </div>
        <div class="col-md-2"  style="font-size:.6em" onclick="menuItemClick('EdiNew');"><center>
            <img style="height:26px; width:20px; object-fit: contain; " src="<?php echo "{$img_dir}";?>art_my.png" alt=""/><br/>
            Nové vydání
        </center></div></div>
<?php include 'include/applet/a_editions.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
                    <h5 class="mb-5" id="edit_header">Editace vydání</h5>
<?php include 'include/applet/a_edition_admin.php'; ?>
    <div class="form-group">
        <label for="editorNote">Poznámka události</label>
        <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte poznámku k události"></textarea>
    </div>

    <div class="form-buttons">
        <button class="btn btn-success" onclick="aPost()">Odeslat</button>
    </div>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
    $( document ).ready(function () {
    editionsLoad(0,0);
    messagesLoad(5,0);
    setLayout(3);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrAdm") {window.location.replace('user_admin.php');}
    if (index=="EdiNew") {aFormEmpty();condLayout(1,3);condLayout(2,3);}
    if (index=="EdiAdm") {}
    if (index=="ArtRed") {window.location.replace('article_redactor.php');}
    if (index=="ArtOpp") {window.location.replace('article_opponent.php');}
    if (index=="ArtNew") {window.location.replace('article_author.php');}
    if (index=="ArtAut") {window.location.replace('article_author.php');}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function editionClick(index,version){
    console.log('Edition:'+index+','+version);
    messagesLoad(5,index);
    aFormLoad(index);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
};
</script>


<?php include 'include/footer.php'; ?>
    
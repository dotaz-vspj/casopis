<?php 
// Template Administračního rozhraní Verse 2.0
// Plné menu, kliknutí předáváno pomocí "intuitivních" parametrů
// Seznam článků bez hlavičky a s upravenými barvami podle stavu

include 'include/session_open.php'; ?>
<?php $scriptName="user_admin";
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
        <h5 class="mb-5">Seznam uživatelů</h5>
        </div>
        <div class="col-md-2"  style="font-size:.6em" onclick="menuItemClick('UsrNew');"><center>
            <img style="height:26px; width:20px; object-fit: contain; " src="<?php echo "{$img_dir}";?>profile.png" alt=""/><br/>
            Nový uživatel
        </center></div></div>
<?php include 'include/applet/a_users.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3 overflow-x-auto" id="main-out" onclick="condLayout(2,0);">
                    <h5 class="mb-5">Editace uživatele</h5>
<?php include 'include/applet/a_user_admin.php'; ?>
    <div class="form-group">
        <label for="editorNote">Poznámka události</label>
        <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte poznámku k události"></textarea>
    </div>

    <div class="form-buttons">
        <button class="btn btn-success" onclick="aPost()">Odeslat</button>
    </div>
</div>

<!-- Messages -->
<div class="mx-3 bg-light overflow-x-auto" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
    $( document ).ready(function () {
    aUserEmpty();
    usersLoad(0,0);
    messagesLoad(4,0);
    setLayout(2);
});
function menuItemClick(index){
    console.log('Menu:'+index);
    if (index=="UsrNew") {aUserEmpty();condLayout(1,3);condLayout(2,3);}
    if (index=="UsrAdm") {}
    if (index=="EdiAdm") {window.location.replace('edition_admin.php');}
    if (index=="ArtRed") {window.location.replace('article_redactor.php');}
    if (index=="ArtOpp") {window.location.replace('article_opponent.php');}
    if (index=="ArtAut") {window.location.replace('article_author.php');}
    if (index=="Profile") {window.location.replace('profile.php');}
    if (index=="Message") {condLayout(3,2);}
}; 
function userClick(index,version){
    console.log('Article:'+index+','+version);
    messagesLoad(4,index);
    aUserLoad(index);
};
function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
};
function aPost(){
    aUserPost($("#editorNote").val());
}
function onUserDone (it) {
    if (it.value==0) {
        usersLoad(0,0);
        messagesLoad(4,0);
        aUserLoad($("#ID").val());
        condLayout(1,3);condLayout(2,3);        
    }
}
</script>


<?php include 'include/footer.php'; ?>
    
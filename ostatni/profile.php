<?php
// Vázáno na Administrační rozhraní Verse 2.0
// maketa, funkční menu.
include 'include/session_open.php'; ?>
<?php $scriptName="Profile";
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
<div class="pt-3 overflow-hidden" id="list-out"><div class="h-100" style="width:800px;">
                    <h5 class="mb-5">Moje články</h5>
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
<?php
echo "<p>Toto je <B>MAKETA</B> profilové stránky uživatele. Slouží vstupu do administračního rozhraní.<br/> Ve sprintu 3 bude upravena.</p>"; 
        var_dump($_SESSION);
if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM RSP_SESSION WHERE Login = :login AND `SessionTag` = :session_tag LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->bindParam(':session_tag', $_SESSION['user']['session_tag'], PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $session = $stmt->fetch();
        echo '<p>Session Hash: ' . htmlspecialchars($session['SessionTag']) . '</p>';
    }
}
?>
</div>

<!-- Messages -->
<div class="mx-3 bg-light h-100" id="messages-out" onclick="condLayout(0,2);" style="overflow-y: scroll;">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
    $( document ).ready(function () {
    articlesLoad(3,"21,22,24");
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
};
</script>


<?php include 'include/footer.php'; ?>
    
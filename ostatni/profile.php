<?php
// Vázáno na Administrační rozhraní Verse 2.0
// maketa, funkční menu.
include 'include/session_open.php'; ?>
<?php $scriptName="Profile";
if ($myFunc>24) {Header("location:index.php");die;}    
?>
<?php include 'include/header.php'; ?>

<div  id="tt-application">
<div  class="tt-row">
<!-- Menu -->
<div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px; ">
<?php include 'include/applet/a_menu.php'; ?>
</div>

<!-- List -->
<div class="pt-3" id="list-out"><div class="h-100" style="width:800px;">
                    <h5 class="mb-5">Moje články</h5>
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);" style="padding:20px;">
    <H5>Vítejte v administračním rozhraní systému <B>DOTAZ</B></H5>
    <p></p><p>Jste přihlášen jako uživatel <B>
<?php
    $sql = "SELECT U.Func, F.descr, "
       . 'CONCAT(case when TitleF is null then "" else CONCAT(TitleF," ") end,FirstName," ",LastName,case when TitleP is null then "" else CONCAT(", ",TitleP) end) fullName '
       . "FROM `RSP_USER` U left join `RSP_CC_USER_Func` F on U.Func=F.ID where U.ID=".$myID;
    $result = $conn->query($sql);
    $ME = $result->fetchObject();
    echo $ME->fullName; ?>
        </B> s oprávněním <B>"<?php echo $ME->descr; ?>"</B></p>
    <p>V systému máte přístup k <B> 
<?php
    $sql = "SELECT (SELECT count(ID) from `RSP_ARTICLE` where hasAccess(".$myID.",ID)) access, "
            . "(SELECT count(ID) from `RSP_ARTICLE` where Creator=".$myID.") owner, "
            . "(SELECT MAX(ID) from `RSP_ARTICLE` where hasAccess(".$myID.",ID)) last";
    $result = $conn->query($sql);
    $ME = $result->fetchObject();
    echo $ME->access; ?>
        </B> článkům a jste vlastníkem <B><?php echo $ME->owner; ?></B> článků -> k nahlédnutí od posledního: &nbsp;
         <a href="article.php?id=<?php echo $ME->last; ?>" target="_preview"><button type="button" class="btn btn-primary mt-2" onclick="">Seznam článků</button></a>
</p>
    <p>V systému máte evidováno <B> 
<?php
    $sql = "SELECT count(ID) count, MIN(Datum) min, MAX(Datum) max from `RSP_EVENT` where Autor=".$myID;
    $result = $conn->query($sql);
    $ME = $result->fetchObject();
    echo $ME->count; ?>
        </B> vlastních akcí v sekci Zprávy, a to v období od <B><?php echo $ME->min; ?></B> do <B><?php echo $ME->max; ?></B>.</p>
    <p><B>Pro práci se systémem si nejprve vyberte oblast Vaší plánované činnosti z&nbsp;levého menu</B>,<br/>
            aktuálně viditelný seznam článků (bez výběru z&nbsp;menu) je pouze informační přehled <br/>
            a není možné s&nbsp;nimi zde (na&nbsp;<code>profile.php</code>) manipulovat.</p>
    <p>Pokud chcete změnit své registrační údaje, můžete použít toto tlačítko:
     <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateUser">Změnit vlastní údaje</button>
    </p>
    <p>Pro zaslání zprávy redakci použijte tlačítko:
     <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#sendMsg">Zpráva pro redakci</button>
    </p>
<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="newAuthorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAuthorModalLabel">Úprava vlastních údajů</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
           </div>
            <div class="modal-body">
<?php include 'include/applet/a_user_admin.php'; ?>
                    <button type="button" class="btn btn-primary" onclick="updateME();">Upravit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sendMsg" tabindex="-1" aria-labelledby="newMsqModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMsgModalLabel">Zpráva redaktorovi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
           </div>
            <div class="modal-body">
                    <textarea class="form-control" id="editorNote" rows="2" placeholder="Zadejte text zprávy..."></textarea>
                    <button type="button" class="btn btn-primary" onclick="sendIt();">Poslat</button>
            </div>
        </div>
    </div>
</div>
    
 
<?php
/*        var_dump($_SESSION);
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
*/?>
</div>

<!-- Messages -->
<div class="mx-3 bg-light h-100" id="messages-out" onclick="condLayout(0,2);" style="overflow-y: scroll;">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div></div>
<script>
  $( document ).ready(function () {
    if (<?php echo $myFunc; ?><20) articlesLoad(2,-2); 
    else articlesLoad(3,"21,22,24");
    messagesLoad(6,0);
    setLayout(3);
    aUserLoad(<?php echo $myID; ?>);
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
function updateME() {
    $("#funkce").val(<?php echo $myFunc; ?>);
    aUserPost("");    
};
function onUserDone (it) {
    if (it.value==0) {
        window.location.replace('profile.php');
    }
};
function sendIt () {
      $.post("include/ajax/setMessage.php",
        {
            note: $("#editorNote").val()
        },
        function(d, status){
            if ((status="success")&&(d["status"]==1)) {
                articlesLoad(2,$("#articlesFilter").val()); // obnov seznam článků
                articleClick($("#articleID").val(),d["param"]);
                alert(d["message"]);
        window.location.replace('profile.php');
            } else {
                alert("Status: " + status+"/"+d["status"] + "\n" + d["message"]);
            }
        }
      );
    }
</script>

<?php include 'include/footer.php'; ?>
    
<?php include 'include/session_open.php'; ?>
<?php
$EditionID = isset($_GET['id']) ? htmlentities($_GET['id']) : "";

include 'include/db.php'; 
$sql = "SELECT MAX(ID) from `RSP_EDITION` where Published<now()";
$result = $conn->query($sql);
if ($result->rowCount() == 0) {Header("location:error.php");die;}
if (($EditionID=="")||(!is_numeric($EditionID))) {$EditionID=$result->fetch()[0];}
else {$sql = "SELECT ID from `RSP_EDITION` where ID=".$EditionID;
    $result2 = $conn->query($sql);
    if ($result2->rowCount() == 0) {$EditionID=$result->fetch()[0];}
    else {$EditionID=$result2->fetch()[0];}
} //pokud cokoli nesedělo s GET-předaným ID, tak vezmi poslední publikované vydání (nějaké tam být musí, jinak to spadne !!!
$sql = "SELECT * from `RSP_EDITION` E left join `RSP_USER` U on E.Redactor=U.ID where E.ID=".$EditionID;
$result = $conn->query($sql);
$E=$result->fetchObject();

$sql = "SELECT A.*, case when A.Status=5 then E.Published else C.descr end Published, ".
    "SUBSTRING(A.Abstract, 1, 300) as Abstract FROM `RSP_ARTICLE` A ".
    "left join `RSP_EDITION` E on A.Edition=E.ID ".
    "left join `RSP_CC_ARTICLE_Stat` C on A.Status=C.ID ".
    "where A.Edition=".$EditionID." and hasAccess(".$myID.",A.ID)";
$result = $conn->query($sql);
?>
<?php include 'include/header.php'; ?>
<div class="row w-100" style="min-height: 100vh; margin:0 auto 0 auto; padding-top: 90px;">
    <!-- Menu -->
    <div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px;">
        <ul class="nav flex-column">
            <li class="nav-item" onclick="menuItemClick(1);"><center>
                <img style="height:65px; width:50px; object-fit: contain;" src=<?php echo "{$img_dir}art_new.png";?> alt=""/><br/>
                Nový článek</center>
            </li>
            <li class="nav-item" onclick="menuItemClick(2);"><center>
                <img style="height:65px; width:50px; object-fit: contain;" src=<?php echo "{$img_dir}art_my.png";?> alt=""/><br/>
                Autorské články</center>
            </li>
            <li class="nav-item" onclick="menuItemClick(3);"><center>
                <img style="height:65px; width:50px; object-fit: contain;" src=<?php echo "{$img_dir}msg.png";?> alt=""/><br/>
                Zprávy</center>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
        <h5 class="mb-5" id="edit_header">Vložení/úprava článku</h5>
        <form>
            <!-- Form fields here... -->
            <div class="form-group author-selectors">
                <div class="w-50">
                    <label for="selectedAuthors">Autoři článku</label>
                    <select multiple class="form-control" id="selectedAuthors" size="5"></select>
                </div>
                <div class="arrows">
                    <button type="button" class="btn btn-outline-secondary" onclick="authorAdd();">&larr;</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="authorRemove();">&rarr;</button>
                </div>
                <div class="w-50">
                    <label for="registeredAuthors">Registrované osoby <input type="checkbox" id="authors_only" onchange="filterAuthors();"> jen autoři</label>
                    <select class="form-control" id="registeredAuthors"></select>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#newAuthorModal">Registrovat neevidovaného autora</button>
                </div>
            </div>
            <!-- Additional form fields... -->
        </form>
    </div>

    <!-- Modal for new author registration -->
    <div class="modal fade" id="newAuthorModal" tabindex="-1" aria-labelledby="newAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newAuthorModalLabel">Registrace nového autora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
                </div>
                <div class="modal-body">
                    <form id="newAuthorForm">
                        <div class="mb-3">
                            <label for="titleBefore" class="form-label">Titul před</label>
                            <input type="text" class="form-control" id="titleBefore" placeholder="např. Ing.">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Příjmení</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Příjmení">
                        </div>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">Jméno</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Jméno">
                        </div>
                        <div class="mb-3">
                            <label for="titleAfter" class="form-label">Titul za</label>
                            <input type="text" class="form-control" id="titleAfter" placeholder="např. Ph.D.">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="registerNewAuthor()">Registrovat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript functions for layout and author handling
    function registerNewAuthor() {
        const titleBefore = $("#titleBefore").val();
        const lastName = $("#lastName").val();
        const firstName = $("#firstName").val();
        const titleAfter = $("#titleAfter").val();
        console.log("Nový autor:", titleBefore, firstName, lastName, titleAfter);
        $('#newAuthorModal').modal('hide');
        // Send data to database - to be implemented
    }
</script>
<?php include 'include/footer.php'; ?>

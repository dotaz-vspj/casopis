<?php 
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
$myID=0; ?>
<?php
$EditionID=htmlentities($_GET['id']);

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
    "where A.Edition=".$EditionID; //" and hasAccess(".$myID.",A.ID)"
$result = $conn->query($sql);


?>
<?php include 'include/header.php'; ?>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="lead-article col-sm-8 mb-5">
                    <h1><?php echo $E->Title;?></h1>
                    <h3>Redaktor:
                        <span class="author">
                            <?php echo $E->LastName.", ".$E->TitleF." ".$E->FirstName." ".$E->TitleP." ";?>
                        </span><br/>
                        Vydáno dne:
                        <span class="published">
                            <?php 
                                if (strtotime($E->Published) === false) {
                                    echo '"' . $E->Published . '"';
                                } else {
                                    echo $E->Published;
                                }
                            ?>
                        </span>
                    </h3>
                    <p class="text-justify"><?php echo $E->Thema;?></p>
                </div>
            </div>
        </div>

        <section class="articles">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="row pt-5">

                                <?php 
                                while ($A=$result->fetchObject()) {?>

                                <div class="mb-5 col-sm-6">
                                    <div class="card">
                                        <img class="card-image" onclick="gotoarticle(<?php echo $A->ID?>)" src="../grafika/picture<?php echo $A->ID;?>.png"/>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <div class="article-title">
                                                    <?php echo $A->Title;?>
                                                </div>
                                                <div class="article-author">
                                                    <?php
                                                        $sql = 'SELECT GROUP_CONCAT(CONCAT(LastName,", ",case when TitleF is null then "" else CONCAT(TitleF," ") end,FirstName,case when TitleP is null then "" else CONCAT(",",TitleP) end) ORDER BY LastName SEPARATOR "; ") FROM `RSP_ARTICLE_ROLE` R left join `RSP_USER` U on R.Person=U.ID where R.Role=24 and R.Article='.$A->ID;
                                                        $result2 = $conn->query($sql);
                                                        echo $result2->fetch()[0];
                                                    ?>
                                                </div>
                                                <div class="article-published">Vydáno dne
                                                    <?php 
                                                        if (strtotime($A->Published) === false) {
                                                            echo '"' . $A->Published . '"';
                                                        } else {
                                                            echo $A->Published;
                                                        }
                                                    ?>
                                                </div>
                                            </h5>

                                            <div class="card-text">
                                                <p><?php echo $A->Abstract;?>... <a href="article.php?id=<?php echo $A->ID;?>">více</a> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php };?>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
<?php include 'include/footer.php'; ?>
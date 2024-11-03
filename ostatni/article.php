<?php 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
$myID=0; ?>
<?php
$ArticleID=htmlentities($_GET['id']);
$category=htmlentities($_GET['cat']);
if (!is_numeric($ArticleID)) {Header("location:index.php");die;}
include 'include/db.php'; 
$sql = "SELECT A.*, case when A.Status=5 then E.Published else C.descr end Published FROM `RSP_ARTICLE` A ".
       "left join `RSP_EDITION` E on A.Edition=E.ID ".
       "left join `RSP_CC_ARTICLE_Stat` C on A.Status=C.ID ".
       "where A.ID=".$ArticleID; //" and hasAccess(".$myID.",".$ArticleID.")"
$result = $conn->query($sql);
if ($result->rowCount() == 0) {Header("location:index.php");die;}
$A=$result->fetchObject();
?>
<?php include 'include/header.php'; ?>
<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="jumbotron mb-5">
                <div class="placeholder ph-article"><img height="400px" src="public/img/picture<?php echo $ArticleID;?>.png" alt="<?php echo $A->Title;?>"></div>
            </div>
<?php // var_dump($A);?>
            <h1 class="text-center title">Název: <?php echo $A->Title;?></h1>
            <div class="row justify-content-end">
                <div class="col-sm-3">Vydáno dne: <span class="date-published"><?php echo $A->Published;?></span></div>
            </div>
            <div class="row mb-2 mt-2">
                <p class="text-justify"><?php echo $A->Abstract;?></p>
            </div>
            <div class="row justify-content-end mb-5">
                <div class="col-sm-3">
                    Autor: <span class="author">
<?php 
$sql = 'SELECT GROUP_CONCAT(CONCAT(LastName,", ",case when TitleF is null then "" else CONCAT(TitleF," ") end,FirstName,case when TitleP is null then "" else CONCAT(",",TitleP) end) ORDER BY LastName SEPARATOR "<br/>\n") FROM `RSP_ARTICLE_ROLE` R left join `RSP_USER` U on R.Person=U.ID where R.Role=24 and R.Article='.$ArticleID;
$result = $conn->query($sql);
echo $result->fetch()[0];
?>
                    </span>
                </div>
            </div>
            <div class="row justify-content-between mb-5">
                <div class="col-sm-2">
                    <a href="<?php 
$sql = 'SELECT MAX(ID) FROM `RSP_ARTICLE` where ID<'.$ArticleID; //" and hasAccess(".$myID.",ID)"
$result = $conn->query($sql);$nID=$result->fetch()[0];
echo (($nID == "")?'javascript:void(0)" style="color:gray; ':'article.php?id='.$nID.'&cat=' . htmlentities($category));
?>" class="prev text-center box-btn btn-size-mid">Předchozí</a>
                </div>
                <div class="col-sm-2">
                    <a href="discusion.php?id=<?php echo htmlentities($ArticleID) . "&cat=" . $category; ?>" class="text-center box-btn btn-size-mid">Diskuze</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?php 
$sql = 'SELECT MIN(ID) FROM `RSP_ARTICLE` where ID>'.$ArticleID; //" and hasAccess(".$myID.",ID)"
$result = $conn->query($sql);$nID=$result->fetch()[0];
echo (($nID == "")?'javascript:void(0)" style="color:gray; ':'article.php?id='.$nID.'&cat=' . htmlentities($category));
?>" class="next text-center box-btn btn-size-mid">Následující</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
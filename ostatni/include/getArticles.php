<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select A.ID, A.Edition, A.Title, A.Status, CC.color from RSP_ARTICLE  A left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID"; // 0 - všechny
if (($FilterType==1)||($FilterType==3)) // jen ty, u nichž má volající správnou funkci (seznam v 'id'), nebo je tvůrcem
    $sql="select A.ID, A.Edition, A.Title, A.Status, CC.color "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role in (".$FilterID.")) X "
        . "left join RSP_ARTICLE A on X.Article=A.ID "
        . "left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID";
if ($FilterType==3)
    $sql.=" UNION select A.ID, A.Edition, A.Title, A.Status, CC.color from RSP_ARTICLE  A left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID where Creator=".$myID;
if ($FilterType==2) {// podle volby redaktora
    if  ($FilterID>0)
    $sql="select A.ID, A.Edition, A.Title, A.Status, CC.color from RSP_ARTICLE  A left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID where Edition=".$FilterID;
    elseif ($FilterID==-1)
    $sql="select A.ID, A.Edition, A.Title, A.Status, CC.color from RSP_ARTICLE  A left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID where Edition is null";
    elseif ($FilterID==-2)
    $sql="select A.ID, A.Edition, A.Title, A.Status, CC.color from RSP_ARTICLE  A left join `RSP_CC_ARTICLE_Stat` CC on A.Status=CC.ID where status not in (3,5)";
}
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
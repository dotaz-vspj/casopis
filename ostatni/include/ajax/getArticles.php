<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select ID, Edition, Title, Status from RSP_ARTICLE"; // 0 - všechny
if ($FilterType==1) // jen ty, u nichž má volající správnou funkci (seznam v 'id'), nebo je tvůrcem
    $sql="select A.ID, A.Edition, A.Title, A.Status "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role in (".$FilterID.")) X "
        . "left join RSP_ARTICLE A on X.Article=A.ID "
        . "UNION select ID, Edition, Title, Status from RSP_ARTICLE where Creator=".$myID;
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
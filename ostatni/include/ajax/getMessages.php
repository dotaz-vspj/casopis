<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID"; // 0 - všechny
if (($FilterType==1)&&($FilterID>0)) // 1 - Jen k danému článku
    $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where Article=".$FilterID;
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_EVENT";
if (($FilterType==1)&&($FilterID>0)) $sql="select * from RSP_EVENT where Article=".$FilterID;
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
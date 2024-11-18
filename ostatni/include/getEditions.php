<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_EDITION"; // 0 - všechny
if ($FilterType==1) $sql="select * from RSP_EDITION where Published is null"; // 1 - jen nepublikované
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>

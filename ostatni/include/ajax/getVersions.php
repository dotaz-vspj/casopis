<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_VERSION"; // 0 - všechny
if ($FilterType==1) $sql="select * from RSP_VERSION where Published is not null"; // 1 - jen publikované
if ($FilterID>0)
    $sql="select * from RSP_VERSION where Article=".$FilterID; // k danému článku
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>

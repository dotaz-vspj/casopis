<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_USER order by LastName, FirstName";
if ($FilterType==1) $sql="select * from RSP_USER where Func>=10 order by LastName, FirstName"; 
elseif ($FilterType==2) $sql="select * from RSP_USER where Func in (21,22,24) order by LastName, FirstName"; 
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>

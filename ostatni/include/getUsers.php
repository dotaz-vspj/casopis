<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_USER where Active>0 order by LastName, FirstName"; // 0- všichni
if ($FilterType==1) $sql="select * from RSP_USER where Active>0 and Func>=10 order by LastName, FirstName"; // 1 - mimo adminů
elseif ($FilterType==2) $sql="select * from RSP_USER where Active>0 and Func in (21,22,24) order by LastName, FirstName"; // 2 - jen dříve publikující autoři a oponenti
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>

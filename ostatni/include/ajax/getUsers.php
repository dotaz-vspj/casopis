<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select * from RSP_USER where Active>=".$FilterID." order by LastName, FirstName"; // 0,0- všichni; 0,1-aktivní
if ($FilterType==1) $sql="select * from RSP_USER where Active>0 and Func>=10 order by LastName, FirstName"; // 1 - mimo adminů
elseif ($FilterType==2) $sql="select * from RSP_USER where Active>0 and Func in (21,22,24) order by LastName, FirstName"; // 2 - jen dříve publikující autoři a oponenti
elseif ($FilterType==3) $sql="select * from RSP_USER where Active>0 and Func>=10 and Func<=21 order by LastName, FirstName"; // 3 - jen oponenti a výš, bez adminů
elseif ($FilterType==4) $sql="select * from RSP_USER where ID in (".$FilterID.")"; // 4 - konkrétní ID
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>

<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID order by E.ID desc"; // 0 - všechny
if (($FilterType==1)&&($FilterID>0)) // 1 - Všechno k danému článku
    $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where Article=".$FilterID. " order by E.ID desc";
if ($FilterType==2) //author
  if ($FilterID>0)  //k článku
    $sql="select CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R "
          . "where R.Person=".$myID." and Article=".$FilterID. " and R.Role in (22,24)) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (3,6,7)order by E.ID desc"; 
  else //author všechny
    $sql="select CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role in (22,24)) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (3,6,7) order by E.ID desc"; 
if ($FilterType==3) //oponent
  if ($FilterID>0) //k článku
    $sql="select CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R "
          . "where R.Person=".$myID." and Article=".$FilterID. " and R.Role=21) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (4,5,11,12,13) order by E.ID desc"; 
  else //opponent všechny
    $sql="select CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role=21) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (4,5,11,12,13) order by E.ID desc"; 
if ($FilterType==4) //user management
    if ($FilterID>0) //k uživateli
        $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type=10 and data like '%ID:".$FilterID."}' order by E.ID desc";
    else 
        $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type=10 order by E.ID desc";
if ($FilterType==5) //edition management
    if ($FilterID>0) //k uživateli
        $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where Edition=".$FilterID." order by E.ID desc";
    else 
        $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where Edition is not null order by E.ID desc";
$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
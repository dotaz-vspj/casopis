<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$FilterType=0;if (isset($_GET['typ'])) $FilterType=htmlentities($_GET['typ']);
$sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID order by E.ID desc"; // 0 - všechny
if (($FilterType==0) && ($FilterID>0)) // konkrétní výběr
    $sql="select CC.descr as TypeText, E.* from RSP_EVENT E left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where E.ID in (".$FilterID.") order by E.ID desc";

if ($FilterType==1) // 1 - Všechno k článkům
  if ($FilterID>0) // k danému článku
    $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
          . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
          . "where Article=".$FilterID. " order by E.ID desc";
  else
    $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
          . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
          . "where type>=9 order by E.ID desc limit 100";
if ($FilterType==2) //author
  if ($FilterID>0)  //k článku
    $sql="select case when CU.descr is null then 'Redaktor' else CU.descr end as Author, CC.descr as TypeText, E.ID, E.Datum, E.Autor, E.Edition, E.Article, E.Type, "
          . "case when E.Type in (31,34,35) then E.Data else null end AS Data, "
          . "case when Type in (13, 14, 30, 32) then null else E.Message end AS Message "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R "
          . "where R.Person=".$myID." and Article=".$FilterID. " and R.Role in (22,24)) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
          . "left join `RSP_ARTICLE_ROLE` R on R.Person=E.Autor and R.Article=E.Article "
          . "left join `RSP_CC_USER_Func` CU on CU.ID=R.Role "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
        . "where type in (11,12,13,14,15,16,20,21,30,31,32,34,35) order by E.ID desc"; 
  else //author všechny
    $sql="select case when CU.descr is null then 'Redaktor' else CU.descr end as Author, CC.descr as TypeText, E.ID, E.Datum, E.Autor,E.Edition, E.Article, E.Type, E.Message, " 
          . "case when E.Type in (31,34,35) then E.Data else null end AS Data "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role in (22,24)) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
          . "left join `RSP_ARTICLE_ROLE` R on R.Person=E.Autor and R.Article=E.Article "
          . "left join `RSP_CC_USER_Func` CU on CU.ID=R.Role "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
        . "where type in (11,12,15,16,20,21,31,34,35) order by E.ID desc"; 
if ($FilterType==3) //oponent
  if ($FilterID>0) //k článku
    $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R "
          . "where R.Person=".$myID." and Article=".$FilterID. " and R.Role=21) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
          . "left join `RSP_USER` U on E.Autor=U.ID "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (13,14,15,18,19,30,31,32,34,35) order by E.ID desc"; 
  else //opponent všechny
    $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* "
        . "from (select distinct Article from RSP_ARTICLE_ROLE R where R.Person=".$myID." and R.Role=21) X "
        . "left join RSP_EVENT E on X.Article=E.Article "
          . "left join `RSP_USER` U on E.Autor=U.ID "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID where type in (13,14,15,18,19,30,31,32,34,35) order by E.ID desc"; 
if ($FilterType==4) //user management
    if ($FilterID>0) //k uživateli
        $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.ID, E.Datum, E.Autor,E.Edition, E.Article, E.Type, concat(E.Data,'<br/>\n',E.Message) Message from RSP_EVENT E "
            . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
              . "left join `RSP_USER` U on E.Autor=U.ID "
        . "where type=1 and data like '%ID:".$FilterID."}' order by E.ID desc";
    else 
        $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.ID, E.Datum, E.Autor,E.Edition, E.Article, E.Type, concat(E.Data,'<br/>\n',E.Message) Message from RSP_EVENT E "
            . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
              . "left join `RSP_USER` U on E.Autor=U.ID "
        . "where type=1 order by E.ID desc";
if ($FilterType==5) //edition management
    if ($FilterID>0) //k uživateli
        $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
            . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
            . "where type=2 and Edition=".$FilterID." order by E.ID desc";
    else 
        $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
            . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
            . "where type=2 and Edition is not null order by E.ID desc";
if ($FilterType==6) //myLastFull
  if ($FilterID>0) //k článku
        $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
        . "where Autor=".$myID." and Article=".$FilterID. " order by E.ID desc limit 1";
  else
              $sql="select concat(U.FirstName,' ',U.LastName) as Author, CC.descr as TypeText, E.* from RSP_EVENT E "
        . "left join `RSP_CC_EVENT_Type` CC on E.Type=CC.ID "
          . "left join `RSP_USER` U on E.Autor=U.ID "
        . "where Autor=".$myID." order by E.ID desc limit 1";

$result = $conn->query($sql);
$data = [];while ($data[]=$result->fetchObject()) {}
echo json_encode($data, JSON_PRETTY_PRINT);
?>
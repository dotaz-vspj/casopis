<?php
function getOppSummary ($conn, $articleID) {
    $oppSum = ["sum"=>0,"acc"=>0,"done"=>0];
    if (!$articleID) die;
    $sql="select R.Person, (SELECT ID from `RSP_EVENT` E where E.Autor=R.Person and type not in (12) ORDER BY ID DESC LIMIT 1) ID "
            . "from `RSP_ARTICLE_ROLE` R " // najdi recenzenty a jejich poslední úkon
            . "where R.Article=".$articleID." and Role=21 and Active_to is null"; 
    $result = $conn->query($sql);
    $opps=[];$sel="";
    while ($opp=$result->fetchObject()) {
        $opps[]=$opp;$oppSum["sum"]++;
        if ($opp->ID) $sel.=$opp->ID.',';
    }
    $sql="SELECT Type, Data from `RSP_EVENT` E where E.ID in (".$sel."0)";
    $result = $conn->query($sql);
    while ($ev=$result->fetchObject()) {
        if (($ev->Type==31)||($ev->Type==32)) $oppSum["acc"]++; 
        if (($ev->Type==34)||($ev->Type==35)) {
            $oppSum["acc"]++;
            $ev=json_decode($ev->Data);
            if (intval($ev->Overall)<=2) $oppSum["done"]++;
        }
    }
    return $oppSum;
}

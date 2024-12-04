<?php
function checkDocument ($target_dir, $documentID, $nonempty, $maxSize, $types) {
    $response=array("status"=>1,"param"=>"","message"=>"File ".$documentID." OK. ");
    if (!file_exists($target_dir)) {
        if (!@mkdir($target_dir, 0777, true)) {
            $response=array("status"=>5,"param"=>"","message"=>"File ERROR: ".error_get_last()['message']);
            return $response;
        } }
    if (empty($_FILES[$documentID])) { // kontrola dokumentu
        if ($nonempty) { // při insertu musí být zadán 
            $response=array("status"=>4,"param"=>$documentID,"message"=>"Žádný soubor ".$documentID." nebyl nahrán");
            return $response;
        }
    } else {
        $FileType = strtolower(pathinfo($_FILES[$documentID]["name"],PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES[$documentID]["size"] > $maxSize) {
            $response=array("status"=>4,"param"=>$documentID,"message"=>"Soubor ".$documentID." je příliš velký - max 5MB");
            return $response;
        }
        // Allow certain file formats, only 
        if(!in_array($FileType,$types)) {
            $response=array("status"=>4,"param"=>$documentID,"message"=>"Povoleny jsou pouze ".$documentID." soubory ".implode(',',$types));
            return $response;
    }   }
    return $response;
}

function setDocument ($target_file,$documentID,$overwrite){
    $response=array("status"=>1,"param"=>"","message"=>"File OK. ");
    if (file_exists($target_file)) {
        if ($overwrite) unlink($target_file);
        else { 
            $response=array("status"=>4,"param"=>$documentID,"message"=>"Soubor {$target_file} již existuje");
            return $response;
    }   }
    if (move_uploaded_file($_FILES[$documentID]["tmp_name"], $target_file)) {
        $response["message"].="\nSoubor ". htmlspecialchars( basename( $_FILES[$documentID]["name"])). " byl nahrán.";
        chmod($target_file, 0755);
    } else {
        $response=array("status"=>4,"param"=>$documentID,"message"=>"Soubor ".$documentID." se nepodařilo nahrát");
        return $response;
    }
    return $response;
}
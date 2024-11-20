    <ul class="nav flex-column">
<?php if ($myFunc<20) { ?>
<?php if ($scriptName=="user_admin") {?>
        <li class="nav-item" onclick="menuItemClick('UsrNew');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>profile.png" alt=""/><br/>
            Nový uživatel</center>
        </li>
<?php } ?>
        <li class="nav-item" onclick="menuItemClick('UsrAdm');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>usr_adm.png" alt=""/><br/>
            Správa uživatelů</center>
        </li>
<?php if ($scriptName=="edition_admin") {  ?>
        <li class="nav-item" onclick="menuItemClick('EdiNew');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>art_my.png" alt=""/><br/>
            Nové vydání</center>
        </li>
<?php } ?>
        <li class="nav-item" onclick="menuItemClick('EdiAdm');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>edi_adm.png" alt=""/><br/>
            Správa vydání</center>
        </li>
        <li class="nav-item" onclick="menuItemClick('ArtRed');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>redakce.png" alt=""/><br/>
            Redakce článků</center>
        </li>
<?php } ?>
<?php if ($myFunc<=21) {?>
        <li class="nav-item" onclick="menuItemClick('ArtOpp');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>art_opp.png" alt=""/><br/>
            Články k oponentuře</center>
        </li>
<?php } ?>
<?php if ($myFunc<=22) {?>
<?php if ($scriptName=="ArticleAuthor") {?>
        <li class="nav-item" onclick="menuItemClick('ArtNew');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>art_new.png" alt=""/><br/>
            Nový článek</center>
        </li>
<?php } ?>
        <li class="nav-item" onclick="menuItemClick('ArtAut');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>art_my.png" alt=""/><br/>
            Autorské články</center>
        </li>
        <li class="nav-item" onclick="menuItemClick('Profile');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>profile.png" alt=""/><br/>
            Profil</center>
        </li>
        <li class="nav-item" onclick="menuItemClick('Message');"><center>
            <img style="height:65px; width:50px; object-fit: contain; " src="<?php echo "{$img_dir}";?>msg.png" alt=""/><br/>
            Zprávy</center>
        </li>
<?php } ?>
    </ul>

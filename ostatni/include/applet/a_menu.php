    <ul class="nav flex-column">
<?php if ($myFunc<20) { ?>
        <li class="nav-item <?php if ($scriptName == "user_admin") echo "active" ?>" onclick="menuItemClick('UsrAdm');"><center>
            <img src="<?php echo "{$img_dir}";?>usr_adm.png" alt=""/><br/>
            Správa uživatelů</center>
        </li>
        <li class="nav-item <?php if ($scriptName == "edition_admin") echo "active" ?>" onclick="menuItemClick('EdiAdm');"><center>
            <img src="<?php echo "{$img_dir}";?>edi_adm.png" alt=""/><br/>
            Správa vydání</center>
        </li>
        <li class="nav-item <?php if ($scriptName == "ArticleRedactor") echo "active" ?>" onclick="menuItemClick('ArtRed');"><center>
            <img src="<?php echo "{$img_dir}";?>redakce.png" alt=""/><br/>
            Redakce článků</center>
        </li>
<?php } ?>
<?php if ($myFunc<=21) {?>
        <li class="nav-item <?php if ($scriptName == "ArticleOpponent") echo "active" ?>" onclick="menuItemClick('ArtOpp');"><center>
            <img src="<?php echo "{$img_dir}";?>art_opp.png" alt=""/><br/>
            Články k oponentuře</center>
        </li>
<?php } ?>
<?php if ($myFunc<=22) {?>
        <li class="nav-item <?php if ($scriptName == "ArticleAuthor") echo "active" ?>" onclick="menuItemClick('ArtAut');"><center>
            <img src="<?php echo "{$img_dir}";?>art_my.png" alt=""/><br/>
            Autorské články</center>
        </li>
        <li class="nav-item <?php if ($scriptName == "Profile") echo "active" ?>" onclick="menuItemClick('Profile');"><center>
            <img src="<?php echo "{$img_dir}";?>profile.png" alt=""/><br/>
            Profil</center>
        </li>
        <li class="nav-item" onclick="menuItemClick('Message');"><center>
            <img src="<?php echo "{$img_dir}";?>msg.png" alt=""/><br/>
            Zprávy</center>
        </li>
<?php } ?>
    </ul>

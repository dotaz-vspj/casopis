<?php include 'include/session_open.php'; ?>
<?php include 'include/db.php'; ?>
<?php include 'include/header.php'; ?>

<div class="row w-100" style="min-height: 100vh; margin:0 auto 0 auto; padding-top: 90px; ">
<!-- Menu -->
<div class="col-sm-1 bg-light" id="leftmenu-out" style="padding-top: 24px; ">
<?php include 'include/applet/a_menu.php'; ?>
</div>

<!-- List -->
<div class="pt-3 overflow-hidden" id="list-out"><div style="width:800px; ">
<?php include 'include/applet/a_articles.php'; ?>
</div></div>

<!-- Main -->
<div class="bg-light mx-3 pt-3" id="main-out" onclick="condLayout(2,0);">
        <H1>MAKETA</H1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed convallis magna eu sem. Sed ac dolor sit amet purus malesuada congue. In convallis. Etiam egestas wisi a erat. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Et harum quidem rerum facilis est et expedita distinctio. Donec vitae arcu. Maecenas libero. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Curabitur bibendum justo non orci. Praesent in mauris eu tortor porttitor accumsan. Fusce suscipit libero eget elit. Curabitur sagittis hendrerit ante.</p>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum fermentum tortor id mi. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Integer imperdiet lectus quis justo. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas libero. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean id metus id velit ullamcorper pulvinar. Maecenas lorem. Aliquam erat volutpat. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Integer malesuada. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Proin in tellus sit amet nibh dignissim sagittis. Curabitur sagittis hendrerit ante. Aliquam in lorem sit amet leo accumsan lacinia. Etiam dictum tincidunt diam. </p>
</div>

<!-- Messages -->
<div class="mx-3 bg-light" id="messages-out" onclick="condLayout(0,2);">
<?php include 'include/applet/a_messages.php'; ?>
</div>

</div>


<?php include 'include/footer.php'; ?>
    
<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<div class="container">
    <?php for ($i = 1; $i < 5; $i++) {?>
    <div class="row mt-5 justify-content-center">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-4 placeholder"></div>
                <div class="col-sm-7">
                    <h1 class="title">Název článku <?php echo $i; ?></h1>
                    <h3>Autor: <span class="author">Jméno Příjmení</span> | Vydáno dne: <span class="date">d.m.Y</span></h3>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nulla dolorum vel repellendus eveniet tempore placeat corrupti iste perferendis! Incidunt, voluptatibus nemo architecto totam nulla commodi sapiente, delectus veniam odit deserunt optio possimus impedit fugit ipsa dolores perferendis inventore earum laborum minus fuga dolore! Impedit delectus dolore dolores aliquam facere.</p>
                    <a href="article.php?id=<?php echo htmlentities($_GET['tag']) . '-' . $i ?>">Více ></a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php include 'include/footer.php'; ?>
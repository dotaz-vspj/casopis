<?php session_start(); ?>
<?php include 'include/header.php'; ?>
    <main class="container pb-5">
        <div class="jumbotron text-center mt-5 mb-5">
            <h1 class="display-4">D.O.T.A.Z</h1>
            <p class="lead">Vítejte na stránkách časopisu o vědě a technice</p>
        </div>

        <section class="articles">
        <?php for($i = 0; $i < 5; $i++) { ?>
            <a class="row mb-5 link-secondary" href="article.php?id=<?php echo $i ?>">
                <div class="col-sm-3">
                    <div class="placeholder ph-250x250"></div>
                </div>
                <div class="col-sm-9">
                    <h3 class="title">Název</h3>
                    <h5>
                        <span class="author">Autor</span> | <span class="published">Vydáno dne ...</span>
                    </h5>
                    <div class="abstract">
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Esse cupiditate architecto ducimus doloremque repudiandae tenetur consequatur. A suscipit quo voluptatum laudantium et quia placeat, est quasi delectus corporis, laboriosam modi molestias ipsa aliquam molestiae voluptatem esse voluptates earum dolores dolore.
                        </p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci tenetur nesciunt odio praesentium exercitationem ea harum sed, porro ex voluptate velit fuga quos atque tempora. Fugit voluptate rerum cumque necessitatibus?</p>

                    </div>
                </div>
            </a>
            <?php } ?>
        </section>
    </main>
<?php include 'include/footer.php'; ?>
<?php session_start(); ?>
<?php include 'include/header.php'; ?>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="lead-article col-sm-8 mb-5">
                    <a href="article.php?id=sci-1" class="row link-secondary">
                        <div class="col-sm-7 placeholder"></div>
                        <div class="col-sm-5">
                            <h1>Název článku</h1>
                            <h3>Autor: <span class="author"></span> | Vydáno dne: <span class="published"></span></h3>
                            <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam dolor tenetur, dicta omnis officia impedit ipsa illo fuga consectetur odio vero nihil commodi et maxime reprehenderit? Dolore, doloremque explicabo dignissimos iusto mollitia fugiat nemo ad amet soluta obcaecati praesentium provident ab, facere nisi nostrum aperiam odit magnam quod itaque illum.</p>
                            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, ut? Illo maiores at error ratione aperiam a dicta obcaecati quisquam tenetur. Consectetur ipsam beatae iusto odit quod nemo aliquam velit quas, expedita quidem id harum?</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <section class="articles">
            <?php $category = 'sci-'; ?>
            <?php for($i = 0; $i < 4; $i++) { ?>
                <?php if($i == 0) { ?>
                    <h3 class="text-center">Věda</h3>
                <?php } elseif ($i == 2) { ?>
                    <?php $category = 'tech-'; ?>
                    <h3 class="text-center">Technika</h3>
                <?php } ?>

                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="row pt-5">
                            <?php for ($j = 2; $j < 5; $j++) {; ?>
                                <a class="mb-5 col-sm-4 link-secondary" href="article.php?id=<?php echo $category . 3 * $i + $j; ?>">
                                    <div>
                                        <div class="placeholder ph-full"></div>
                                        <h3 class="title">Název</h3>
                                        <h5>
                                            <span class="author">Autor</span> | <span class="published">Vydáno dne ...</span>
                                        </h5>
                                        <div class="abstract">
                                            <p>
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Esse cupiditate architecto ducimus doloremque repudiandae tenetur consequatur. A suscipit quo voluptatum laudantium et quia placeat, est quasi delectus corporis, laboriosam modi molestias ipsa aliquam molestiae voluptatem esse voluptates earum dolores dolore.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            <?php };?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
<?php include 'include/footer.php'; ?>
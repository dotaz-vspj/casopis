<?php session_start(); ?>
<?php include 'include/functions.php'; ?>
<?php include 'include/header.php'; ?>
<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="jumbotron mb-5">
                <div class="placeholder ph-article"></div>
            </div>
            <h1 class="text-center title">Název článku <?php echo htmlentities($_GET['id']) ?></h1>
            <div class="row justify-content-end">
                <div class="col-sm-3">Vydáno dne: <span class="date-published"><?php echo date('d.m.Y');?></span></div>
            </div>
            <div class="row mb-2 mt-2">
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod fugiat aut, officia pariatur magnam repellendus deleniti dolore aspernatur doloribus modi obcaecati illo voluptatibus porro cum, molestiae maiores totam rerum! Itaque quo amet repellat praesentium voluptas nulla sequi enim saepe eveniet fuga, optio vel! Dolorem corrupti veritatis nostrum, maiores maxime provident placeat! Reprehenderit provident dolor exercitationem dolores error nemo nisi optio magni dolorem possimus ullam perspiciatis vitae natus odit, eaque quod, ea eveniet fugit. Animi necessitatibus, totam earum consequuntur cumque repudiandae libero qui fuga ut officia et sed laboriosam quisquam dolores, exercitationem natus dolor in eos expedita minus reprehenderit! Eveniet, ut.</p>
                <p class="text-justify">Aliquid alias sed ab dolorem obcaecati non corporis voluptate eum. Excepturi impedit et enim cupiditate veritatis exercitationem voluptates doloribus perferendis nulla magnam non similique, placeat mollitia unde incidunt blanditiis tempora, modi reprehenderit! Dignissimos, doloribus architecto.</p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam hic minus ipsa sapiente omnis quis quos! Vero, nobis? Incidunt cupiditate ad sint perspiciatis ea illum voluptas provident unde accusamus laboriosam doloribus quisquam et aspernatur aliquid, enim quia repellat veniam neque modi exercitationem mollitia magnam. Ducimus velit vel voluptates, distinctio dicta atque veniam incidunt esse quis totam nemo enim vero quia est quod commodi perspiciatis, necessitatibus earum molestiae. Voluptatum, quidem, rem corporis eligendi vero ratione fugit accusantium magnam dicta ea ad, cumque repellendus atque non? Quod, in libero! Quaerat omnis quis aperiam excepturi officia hic cupiditate, illo quibusdam eum id neque.</p>
            </div>
            <div class="row justify-content-end mb-5">
                <div class="col-sm-3">
                    Autor: <span class="author">Jmeno autora</span>
                </div>
            </div>
            <div class="row justify-content-between mb-5">
                <div class="col-sm-2">
                    <a href="article.php?id=<?php
                        echo htmlentities(extractNumber($_GET['id'])[0]) . '-' . htmlentities(extractNumber($_GET['id'])[1] - 1)
                    ?>" class="prev text-center box-btn btn-size-mid">Předchozí</a>
                </div>
                <div class="col-sm-2">
                    <a href="discusion.php?id=<?php echo htmlentities($_GET['id']) ?>" class="text-center box-btn btn-size-mid">Diskuze</a>
                </div>
                <div class="col-sm-2">
                    <a href="article.php?id=<?php
                        echo htmlentities(extractNumber($_GET['id'])[0]) . '-' . htmlentities(extractNumber($_GET['id'])[1] + 1)    
                    ?>" class="next text-center box-btn btn-size-mid">Následující</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
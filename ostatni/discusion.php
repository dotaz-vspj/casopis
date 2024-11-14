<?php include 'include/session_open.php'; ?>
<?php include 'include/functions.php'; ?>
<?php include 'include/header.php'; ?>

<?php 

// store get id in variable with input_var
$id = filter_input(INPUT_GET, 'id', FILTER_UNSAFE_RAW);
// if id is not set, redirect to index.php
if (!isset($id)) {
    header('Location: index.php');
    exit();
}

// store article id in variable
$articleId = extractNumber($id)[0];
// store article number in variable
$articleNumber = extractNumber($id)[1];

?>

<!-- make html with bootstrap in same style as category.php or index.php -->
<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="text-center title">Diskuze k článku <?php echo "[article_name_here]"; ?></h1>
            <div class="row justify-content-end">
                <div class="col-sm-3">Vydáno dne: <span class="date-published"><?php echo date('d.m.Y');?></span></div>
            </div>
            <div class="row mb-2 mt-2">
            <!-- comments left by users, generated by php for cycle -->
            <!-- each row has two columns, one is with users avatar, the other has username, date and comment they posted -->
            <?php for ($i = 0; $i < 10; $i++) : ?>
                <div class="row mb-2">
                    <div class="col-sm-2">
                        <div class="placeholder ph-150x150"></div>
                    </div>
                    <div class="col-sm-10">
                        <p class="text-justify"><strong>Jmeno uzivatele</strong> - <span class="date-published">10.10.2020</span></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod fugiat aut, officia pariatur magnam repellendus deleniti dolore aspernatur doloribus modi obcaecati illo voluptatibus porro cum, molestiae maiores totam rerum! Itaque quo amet repellat praesentium voluptas nulla sequi enim saepe eveniet fuga, optio vel! Dolorem corrupti veritatis nostrum, maiores maxime provident placeat! Reprehenderit provident dolor exercitationem dolores error nemo nisi optio magni dolorem possimus ullam perspiciatis vitae natus odit, eaque quod, ea eveniet fugit. Animi necessitatibus, totam earum consequuntur cumque repudiandae libero qui fuga ut officia et sed laboriosam quisquam dolores, exercitationem natus dolor in eos expedita minus reprehenderit! Eveniet, ut.</p>
                    </div>
                </div>
            <?php endfor; ?>
            </div>
            <div class="row justify-content-end mb-5">
                <div class="col-sm-3">
                    <a href="article.php?id=<?php echo htmlentities($articleId . '-' . $articleNumber) ?>" class="text-center box-btn btn-size-mid">Zpět na článek</a>
                </div>
            </div>
        </div>
    </div>
</div>  




<?php include 'include/footer.php'; ?>


<?php include 'include/session_open.php'; ?>
<?php
$EditionID = isset($_GET['id']) ? htmlentities($_GET['id']) : "";

include 'include/db.php'; ?>

<?php include 'include/header.php'; ?>

<!-- sidebar s prepinanim novy clanek, seznam clanku atd. -->
<div class="col-sm-1 sidebar h-100 position-absolute">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Moje články</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nový článek</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#messages">Zprávy</a>
        </li>
    </ul>
</div>


<!-- Modal -->
<div class="modal right fade" id="messages" data-bs-keyboard="false" tabindex="-1" aria-labelledby="messages" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Zprávy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Zde budou zprávy
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<!-- end sidebar -->

<main class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-8 middle">
            <div class="row">
                <div class="col-sm-3 pl-5">
                    <h5 class="mb-5">Moje články</h5>
                    <ul class="list-unstyled list-group-flush list-group">
                        <li class="list-group-item">Nazev clanku 1</li>
                        <li class="list-group-item">Nazev clanku 2</li>
                        <li class="list-group-item">Nazev clanku 3</li>
                        <li class="list-group-item">Nazev clanku 4</li>
                        <li class="list-group-item">Nazev clanku 5</li>
                        <li class="list-group-item">Nazev clanku 6</li>
                        <li class="list-group-item">Nazev clanku 7</li>
                        <li class="list-group-item">Nazev clanku 8</li>
                    </ul>

                </div>
                <div class="col-sm-9">
                    <h5 class="mb-5">Editor článku</h5>
                    <div class="container">

                        <!-- form start -->

                        <form class="editor" action="#" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <label for="title" class="form-label">Název článku</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="main_author" class="form-label">Seznam autorů</label><br>
                                    <select class="form-select" aria-label="Default-select-example" name="author" id="author">
                                        <option value="Main Author 1">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Main Author 2">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Main Author 3">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Main Author 4">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Main Author 5">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="co_author" class="form-label">Další autor</label><br>
                                    <select class="form-select" aria-label="Default-select-example" name="author" id="author">
                                        <option value="Author 1">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Author 2">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Author 3">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Author 4">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                        <option value="Author 5">
                                            <span class="author_fname">Jmeno</span>
                                            <span class="author_lname">Prijmeni</span>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="articleText" placeholder="Text clanku" id="articleText"></textarea>
                                        <label for="articleText">Text článku</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="d-grid col-sm-12 gap-2 d-sm-flex justify-content-around">
                                    <button class="btn btn-primary">Edice</button> <!-- ??? -->
                                    
                                    <!-- Custom file input for document -->
                                    <label class="btn btn-primary" for="document">Upload Document</label>
                                    <input class="form-control" id="document" name="document" type="file" style="display: none;">
                                    
                                    <!-- Custom file input for image -->
                                    <label class="btn btn-primary" for="image">Upload Image</label>
                                    <input class="form-control" id="image" name="image" type="file" style="display: none;">
                                    
                                    <button class="btn btn-success" name="submit" type="submit">Uložit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>


</main>

<?php include 'include/footer.php'; ?>
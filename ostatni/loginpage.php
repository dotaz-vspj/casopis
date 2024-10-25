<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 p-5 text-center login-register-form m-5">
            <form action="include/login.php" method="post">
            <div class="form-group">
                <label class="m-2" id="username">Přihlašovací jméno</label>
                <input type="text" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label class="m-2" id="password">Heslo</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <button class="btn btn-size-mid box-btn btn-dark" type="submit">Přihlásit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>
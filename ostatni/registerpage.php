<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 p-5 text-center login-register-form m-5">
            <form action="include/register.php" method="post">
            <div class="form-group">
                <label class="m-2" id="username">Přihlašovací jméno</label>
                <input type="text" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label class="m-2" id="email">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label class="m-2" id="password">Heslo</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label class="m-2" id="password_confirm">Potvrzení hesla</label>
                <input type="password" class="form-control" id="password_confirm">
            </div>
            <div class="form-group">
                <button class="btn btn-size-mid box-btn btn-dark" type="submit">Registrovat</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>
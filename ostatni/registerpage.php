<?php include 'include/session_open.php'; ?>
<?php include 'include/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 p-5 text-center login-register-form m-5">
                    <h5 class="mb-5">Registrace nového uživatele (příspěvky)</h5>
<?php include 'include/applet/a_user_admin.php'; ?>
            <div class="form-group">
                <button class="btn btn-size-mid box-btn btn-dark" type="submit" onclick="aPost();">Registrovat</button>
            </div>
        </div>
    </div>
</div>
<script>
function aPost(){
    aUserPost("");
}
function onDone (it) {
    if (it.value==0) {
        window.location.replace('index.php');
    }
}
</script>
<?php include 'include/footer.php'; ?>
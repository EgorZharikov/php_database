<?php
if(isset($_SESSION['upload_errors'])) {
   $fail = $_SESSION['upload_errors'];
} else {
    $fail = '';
}
?>
<div class="container col-sm-5">
    <div class="row profile-card ">
        <div class="col border border-primary-subtle align-items-center">
            <div>
                <h4 class="m-3">Мои данные:</h4>
            </div>
            <div class="border">
                Имя пользователя: <?php echo $username?>
            </div>
            <form action="/upload" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                        <div class="input-group">
                            <input type="file" class="form-control" name="files[]" accept=".jpg,.png" id="inputFile" aria-describedby="inputFileAddon" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="submit" id="inputFileAddon">Загрузить</button>
                        </div>
            </div>
            </form>
            <div class="alert alert-danger mt-3 <?php if ($fail === '') echo 'collapse' ?>" role="alert"> <?php echo $fail ?>
                 </div>
            <form method="post" action="">
                <button type="submit" name="signout" class="btn btn-primary m-3">Выйти</button>
            </form>
        </div>
    </div>
</div>
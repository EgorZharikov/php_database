<?php $fail = $data->errors ?? '';?> 
<div class="container col-sm-5">
    <div class="row profile-card ">
        <div class="col border border-primary-subtle align-items-center">
            <div class="alert alert-danger mt-3" role="alert"> <?php echo $fail ?>
            </div>
            <a href="/account/profile" class="btn btn-primary m-3">Назад</a>
        </div>
    </div>
</div>
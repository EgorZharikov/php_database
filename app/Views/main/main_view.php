<div class="container mb-3 mt-5">
<div class="col align-items-center">
<?php $images = $data->data; ?>
<?php if(!empty($images)): ?>
<?php foreach($images as $image): ?>
    <a href="/img?name=<?= $image['name'] ?>"><img src="<?=APP_CONFIG['UPLOAD_DIR_NAME'] . '/' . $image['name']?>" alt="Logo" width="100" height="" class="d-inline-block m-2"></a>
    <?php endforeach; ?>
<?php endif; ?>
</div>
</div>

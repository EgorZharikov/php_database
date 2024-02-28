<?php $userID = $_SESSION['id'] ?? null; ?>
<div class="container mb-3 mt-5">
<div class="row align-items-center">
<?php echo '<img src="'. APP_CONFIG['UPLOAD_DIR'] . '/' . $name . '"'. 'alt="Logo" class="d-inline-block align-text-top">'; ?>
<div class="m-1">Загрузил <?=$data->imgData[0]['login'];?> <?=date('m/d/Y H:i:s', $data->imgData[0]['timestamp']);?></div>
<?php if(intval($data->imgData[0]['user_id']) === intval($userID)): ?>
<form action="/img?name=<?=$name?>" method="POST">
<button type="submit" class="btn btn-primary" name="remove_image"
        style="--bs-btn-padding-y: 0.5rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: 1rem;">
  Удалить картинку
</button>
<input type="hidden"  value="<?=$data->imgData[0]['user_id']?>" name="img_user_id">
<input type="hidden"  value="<?=$data->imgData[0]['image_id']?>" name="image_id">
<input type="hidden"  value="<?=$name?>" name="image_name">
</form>
<?php endif; ?>
</div>
</div>
<section class="container">
<div class="row">
<?php if($userID): ?>
<div class="col-md-12">
<div class="panel">
 <div class="panel-body">
    <form action="/img?name=<?=$name?>" method="POST">
 <textarea class="form-control" name="text_comment" rows="2" placeholder="Добавьте Ваш комментарий"></textarea>
 <div class="mar-top clearfix">
 <button class="btn btn-sm btn-primary pull-right mb-5" name="add_coment" type="submit"><i class="fa fa-pencil fa-fw"></i> Добавить</button>
 </div>
 </form>
 </div>
</div>
<?php endif; ?>
<div class="panel">
 <div class="panel-body">
 <!-- Содержание Новостей -->
 <!--===================================================-->
<!-- Комментарий -->
<?php $comments = $data->commentsData; ?>
<?php if(!empty($comments)): ?>
<?php foreach($comments as $comment): ?>
    <div>
 <div class="media-block pad-all">
 <a class="media-left" href="#"><img class="img-circle img-sm" alt="Профиль пользователя" src="https://bootstraptema.ru/snippets/icons/2016/mia/5.png"></a>
 <div class="media-body">
 <div class="mar-btm">
 <a href="#" class="btn-link text-semibold media-heading box-inline"><?=$comment['user']?></a>
 <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> <?=date('m/d/Y H:i:s', $comment['timestamp']);?></p>
 </div>
 <p><a href="http://bootstraptema.ru/" target="_blank" class="btn" ><?=$comment['content']?></a></p>
 <?php if(intval($comment['user_id']) === intval($userID)): ?>
 <form action="/img?name=<?=$name?>" method="POST">
 <button type="submit" class="btn btn-primary mb-3" name="remove_comment"
        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
  Удалить
</button>
<input type="hidden"  value="<?=$comment['user_id']?>" name="user_id">
<input type="hidden"  value="<?=$comment['comment_id']?>" name="comment_id">
</form>
<?php endif; ?>
 </div>
 </div>
 </div>
    <?php endforeach; ?>
<?php endif; ?>
 

 <!--===================================================-->
 <!-- Конец Содержания Новостей -->
 </div>
</div>
</div>

</div><!-- /.row -->
</section><!-- /.container -->


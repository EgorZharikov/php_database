<?php $fail = $data ? $data : ''; ?>
 <div class="container">
     <div class="row account-card align-items-center">
         <div class="col col-md-3 offset-md-4">
             <div class="account-logo">
                 <img class="mb-4" src="/images/logo.png" alt="" width="72" height="57">
                 <h3 class="h3 mb-3 fw-normal">Please sign in</h3>
             </div>
             <form name="signin-form" action="" method="post">
                 <div class="mb-3">
                     <label for="inputLogin" class="form-label">Login</label>
                     <input type="text" name="username" class="form-control" id="inputLogin">

                 </div>
                 <div class="mb-3">
                     <label for="inputPassword" class="form-label">Password</label>
                     <input type="password" name="password" class="form-control" id="inputPassword">
                 </div>
                 <div class="d-grid gap-2">
                     <button type="submit" name="signin" class="btn btn-primary">Войти</button>
                 </div>
                 <div class="mt-1 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="save_user">
                    <label class="form-check-label" for="exampleCheck1">Сохранить вход</label>
                </div>
                 
                 <div class="account-logo mt-3"><a href="/account/signup">Создать аккаунт</a></div>
                 <div class="alert alert-danger mt-3 <?php if ($fail === '') echo 'collapse' ?>" role="alert"> <?php echo $fail ?>
                 </div>
             </form>
         </div>
     </div>
 </div>
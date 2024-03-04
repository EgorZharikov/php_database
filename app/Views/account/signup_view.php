<?php $fail = $data ? $data : ''; ?>
 <div class="container">
     <div class="row account-card align-items-center">
         <div class="col col-md-3 offset-md-4">
             <div class="account-logo">
                 <img class="mb-4" src="/images/logo.png" alt="" width="72" height="57">
                 <h3 class="h3 mb-3 fw-normal">Please sign up</h3>
             </div>
             <form name="signup_form" method="post" action="signup">
                 <div class="mb-3">
                     <label for="inputLogin" class="form-label">Login</label>
                     <input type="text" name="username" class="form-control" id="inputLogin">
                 </div>
                 <div class="mb-3">
                     <label for="InputPassword" class="form-label">Password</label>
                     <input type="password" name="password" class="form-control" id="InputPassword">
                 </div>
                 <div class="mb-3">
                     <label for="inputConfirmPassword" class="form-label">Confirm password</label>
                     <input type="password" name="confirm" class="form-control" id="inputConfirmPassword">
                 </div>
                 <div class="d-grid gap-2">
                     <button type="submit" name="signup" id="signIn" class="btn btn-primary">Отправить</button>
                 </div>
                 <div class="alert alert-danger mt-3 <?php if ($fail === '') echo 'collapse' ?>" role="alert"> <?php echo $fail ?>
                 </div>
             </form>
         </div>
     </div>
 </div>
<?php
if (isset($username)) {
$collapse = 'collapse';
} else { 
    $username = '';
    $collapse = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImgOcean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/main">
                    <img src="/images/logo.png" alt="Logo" width="35" height="30" class="d-inline-block align-text-top">
                    ImgOcean
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/main">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Избранное</a>
                        </li>
                    </ul>

                    <a class="nav-link m-2 <?php echo $collapse ? false : 'collapse' ?>" aria-current="page" style="color: green; font-weight: bold" href="/account/profile">
                        <img src="/images/user.png" alt="Logo" width="20" height="17" class="d-inline-block align-text-top">
                        <?php echo $username ?></a>

                        <a href="/account/signin" class="btn btn-outline-dark <?php echo $collapse ?> ">Sign in</a>
                    
                </div>
            </div>
        </nav>

    </header>
    <?php echo $content_view; ?>
</body>

<footer>
    <div class="container">
        <div class="links">
            <a href="#">Контакты</a>
            <a href="#">О нас</a>
            <a href="#">Реклама</a>
        </div>
    </div>
</footer>

</html>
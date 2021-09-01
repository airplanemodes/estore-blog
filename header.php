<?php
    include_once './util.php';
    
    if (session_id() == '') {
        session_start();
    }
    
    $user = user_verify();

    include './head.php';
?>
<header class="container-fluid bg-dark">
<div class="container text-white p-2">
    <div class="row align-items-center">
        <div class="col-lg-3">
            <h2><strong>Learning PHP</strong></h2>
        </div>
        <nav class="col-lg-3 logo">
            <a href="index.php" class="text-white me-2">Home</a>
            <a href="about.php" class="text-white me-2">About</a>
        </nav>
        <nav class="col-lg-6 text-end">
        <?php if($user) : ?>
            <span class="me-5 text-warning">Welcome <?= $_SESSION['user_name'] ?>!</span>
            <a href="products.php" class="text-white me-2">Products</a>
            <a href="logout.php" class="text-white me-2">Logout</a>
            <div class="ms-2 border" style="float:right; width:32px; height:32px; background-image:url(<?= $_SESSION["user_img"] ?>); background-size:cover; background-position:center; border-radius:50%;"></div>
        <?php endif; ?>
        <?php if(!$user) : ?>
            <a href="login.php" class="text-white me-2">Login</a>
            <a href="signup.php" class="text-white me-2">Register</a>
        <?php endif; ?>
        </nav>
    </div>
</div>
</header>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : "PHP Website" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header class="container-fluid bg-dark">
<div class="container text-white p-2">
    <div class="row align-items-center">
        <div class="col-lg-2">
            <h2>Learning PHP</h2>
        </div>
        <nav class="col-lg-4 logo">
            <a href="index.php" class="text-white me-2">Home</a>
            <a href="about.php" class="text-white me-2">About</a>
        </nav>
        <nav class="col-lg-6 text-end">
            <a href="signup.php" class="text-white me-2">Sign-Up</a>
        </nav>
    </div>
</div>
</header>

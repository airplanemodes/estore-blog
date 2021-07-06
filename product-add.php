<?php
    $page_title = "Add product";
    $errors = []; # associative array for errors

    include './connect.php';
    include_once './util.php';

    session_start();

    if (!user_verify()) {
        header('location:login.php?auth=error');
        exit; # stops all code
    }

    if (isset($_POST['submit'])) {
        $form_valid = true;
        $title = filter_post('title', $conn);
        $info = filter_post('info', $conn);
        $price = filter_post('price', $conn);
        $img_url = filter_post('img_url', $conn);

        if (strlen($title) < 2) {
            $form_valid = false;
            $errors['title'] = "Please enter valid title";
        }
    
        if (strlen($info) < 2) {
            $form_valid = false;
            $errors['info'] = "Please enter valid info";
        }
    
        if (strlen($price) < 1) {
            $form_valid = false;
            $errors['price'] = "Please enter valid price";
        }
    
        if ($form_valid) {
            $query_insert = "INSERT INTO products (title, info, price, img_url, user_id) VALUES ('{$title}', '{$info}', '{$price}', '{$img_url}', '{$_SESSION['user_id']}')";
            $result = $conn->query($query_insert);

            if ($conn -> insert_id > 0) {
                header('location:products.php?msg=Success!');
            } else {
                $errors['general'] = "Something wrong";
            }
        }

        
    }

    include './header.php';
?>
<main class="container-fluid">
    <div class="container">
        <h2 class="pt-4 mb-4">Add new product</h2>
        <h4 class="text-danger"><?= isset($errors['general']) ? $errors['general'] : "" ?></h4>
        <form method="post" class="col-lg-6 shadow p-3">
        <div>
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= old('title') ?>">
                <small class="text-danger"><?= showError("title", $errors) ?></small>
        </div>
        <div>
            <label>Info</label>
            <textarea name="info" class="form-control"><?= old('info') ?></textarea>
                <small class="text-danger"><?= showError("info", $errors) ?></small>
        </div>
        <div>
            <label>Price USD</label>
            <input type="number" name="price" class="form-control" value="<?= old('price') ?>">
                <small class="text-danger"><?= showError("price", $errors) ?></small>
        </div>
        <div>
            <label>Image URL</label>
            <input type="text" name="img_url" class="form-control" value="<?= old('img_url') ?>">
                <small class="text-danger"><?= showError("img_url", $errors) ?></small>
        </div>
        <button name="submit" class="btn btn-primary mt-2">Add</button>
        </form>
    </div>
</main>
<?php include './footer.php' ?>
<?php
    $page_title = "Edit product";
    $errors = []; # associative array for errors

    include_once './connect.php';
    include_once './util.php';

    session_start();

    if (!user_verify()) {
        header('location:login.php?auth=error');
        exit; # stops all code
    }

    if (!isset($_GET['editid'])) {
        header('location:products.php?msg=Security alert! We already come for you!');
    }

    $editid = filter_get("editid", $conn);
    $query_select = "SELECT * FROM products WHERE id = {$editid} AND user_id = {$_SESSION['user_id']}";
    $result_select = $conn->query($query_select);
    if (mysqli_num_rows($result_select) == 1) {
        $product = mysqli_fetch_assoc($result_select);
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
            $query_update = "UPDATE products SET title = '{$title}', info = '{$info}', price = {$price}, img_url = '{$img_url}' WHERE id = {$editid} AND user_id = {$_SESSION['user_id']};";
            $result = $conn->query($query_update);

            if ($result && mysqli_affected_rows($conn) == 1) {
                header('location:products.php?msg=Product has been edited successfully!');
            } else {
                $errors['generals'] = "There is a problem try again later";
            }
        }

        
    }
    
    include './header.php';
?>
<main class="container-fluid">
    <div class="container">
        <h2 class="pt-4 mb-4">Edit product <?= $product['title'] ?></h2>
        <h4 class="text-danger"><?= isset($errors['general']) ? $errors['general'] : "" ?></h4>
        <form method="post" class="col-lg-6 shadow p-3">
        <div>
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= $product['title'] ?>">
                <small class="text-danger"><?= showError("title", $errors) ?></small>
        </div>
        <div>
            <label>Info</label>
            <textarea name="info" class="form-control"><?= $product['info'] ?></textarea>
                <small class="text-danger"><?= showError("info", $errors) ?></small>
        </div>
        <div>
            <label>Price (in USD)</label>
            <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>">
                <small class="text-danger"><?= showError("price", $errors) ?></small>
        </div>
        <div>
            <label>Image URL</label>
            <input type="text" name="img_url" class="form-control" value="<?= $product['img_url'] ?>">
                <small class="text-danger"><?= showError("img_url", $errors) ?></small>
        </div>
        <a href="products.php" class="btn btn-dark mt-3">Back to list</a>
        <button name="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</main>
<?php include './footer.php' ?>
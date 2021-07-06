<?php
$page_title = "Sign-up";
$errors = []; # associative array for errors

include './connect.php';
include_once './util.php';

if (isset($_POST['submit'])) {
    $form_valid = true; # validation flag

    $username = filter_post('username', $conn);
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = filter_post('password', $conn);
    $password2 = filter_post('password2', $conn);

    if (strlen($username) < 2) {
        $form_valid = false;
        $errors['username'] = "Please enter valid username";
    }

    if (!$email) {
        $form_valid = false;
        $errors['email'] = "Please enter valid e-mail address";
    }

    if (strlen($password) < 6) {
        $form_valid = false;
        $errors['password'] = "Password must be atleast 6 chars";
    }

    if ($password != $password2) {
        $form_valid = false;
        $errors['password2'] = "Passwords not match, please try again";
    }

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $max_file_size = 5 * 1024 * 1024;
        if ($_FILES['avatar']['size'] > $max_file_size) {
            $form_valid = false;
            $errors['file_max'] = "File size must be up to 5mb";
        }
        $ex = ['png', 'jpg', 'jpeg'];
        $file_info = pathinfo($_FILES['avatar']['name']);
        
        if (!in_array(strtolower($file_info['extension']), $ex)) {
            $form_valid = false;
            $errors['file_type'] = "File must be png or jpg";
        }
    }

    if ($form_valid) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password');";
        $result = $conn -> query($query_insert);
        if ($conn -> insert_id > 0) {
            echo "Success";
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $file_info = pathinfo($_FILES['avatar']['name']);
                $user_id = $conn -> insert_id;
                $file_name = "avatars/".$user_id.".".$file_info['extension'];
                move_uploaded_file($_FILES['avatar']['tmp_name'], $file_name);
                $query_edit = "UPDATE users SET img_url = '{$file_name}' WHERE id = {$user_id}";
                $result_edit = $conn -> query($query_edit);
            }
            header('location:login.php?success=ok');
            
        } else {
            echo "Something wrong";
        }
    }
}

    include './header.php';
?>
<main class="container-fluid">
    <div class="container">
    <h1 class="text-center pt-4 mb-4">Sign-Up</h1>
    <form method="post" class="col-lg-4 shadow p-3 mx-auto border" enctype="multipart/form-data">
        <div>
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= old('username') ?>">
                <small class="text-danger"><?= showError("username", $errors) ?></small>
        </div>
        <div>
            <label>E-Mail</label>
            <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                <small class="text-danger"><?= showError("email", $errors) ?></small>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?= old('password') ?>">
                <small class="text-danger"><?= showError("password", $errors) ?></small>
        </div>
        <div>
            <label>Confirm password</label>
            <input type="password" name="password2" class="form-control" value="<?= old('password2') ?>">
                <small class="text-danger"><?= showError("password2", $errors) ?></small>
        </div>
        <div>
            <label>Profile image</label>
            <input type="file" name="avatar" class="form-control">
                <small class="text-danger"><?= showError("file_max", $errors) ?></small>
                <small class="text-danger"><?= showError("file_type", $errors) ?></small>
        </div>
        <button name="submit" class="btn btn-dark mt-3 w-100 formSubmitBtn">Submit</button>
    </form>
    </div>
</main>
<?php include './footer.php' ?>
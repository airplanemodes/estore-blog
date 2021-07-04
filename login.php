<?php
    $page_title = "Sign-In";
    $errors = []; # associative array for errors

    include './connect.php';
    include './util.php';

    session_start();

    if (isset($_POST['submit'])) {
        $form_valid = true; # validation flag
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $password = filter_post('password', $conn);

        if (!$email) {
            $form_valid = false;
            $errors['email'] = "Please enter valid e-mail address";
        }
    
        if (strlen($password) < 6) {
            $form_valid = false;
            $errors['password'] = "Password must be atleast 6 chars";
        }

        if ($form_valid) {
            $query = "SELECT * FROM users WHERE email = '$email';";
            $result = $conn->query($query);

            // check if atleast one row has returned on answer
            if(mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);

                # work log
                // print_r($user);

                if (password_verify($password, $user['password'])) {
                    // next security layer
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['username'];
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    header('location:products.php');

                } else {
                    echo "Something wrong";

                }
                
            } else {
                echo "Something wrong";

            }
        }
    }

    include './header.php';
?>
<main class="container-fluid">
    <div class="container">
    <h1 class="text-center pt-4 mb-4">Sign-In</h1>
    <form method="post" class="col-lg-4 shadow p-3 mx-auto border">
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
        <button name="submit" class="btn btn-dark mt-3 w-100 formSubmitBtn">Login</button>
    </form>
    </div>
</main>
<?php include './footer.php' ?>
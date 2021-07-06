<?php
    $page_title = "Delete product";
    include_once './connect.php';
    include_once './util.php';

    session_start();

    if (!user_verify()) {
        header('location: login.php?auth=error');
        exit;
    }

    if (isset($_GET['delid'])) {
        $delid = filter_get('delid', $conn);
        $query = "DELETE FROM products WHERE id = {$delid} AND user_id = {$_SESSION['user_id']}";
        $result = $conn->query($query);
        if ($result && mysqli_affected_rows($conn) == 1) {
            header('location: products.php?msg=Product has been deleted!');
        } else {
            header('location: products.php?msg=Product has not been deleted!');
        }
    }
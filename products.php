<?php
    $page_title = "Products";
    include './connect.php';
    include_once './util.php';

    session_start();

    if (!user_verify()) {
        header('location:login.php?auth=error');
        exit; # stops all code
    }

        // gets data rows of the connected user
        $query_show = "SELECT * FROM products WHERE user_id = {$_SESSION['user_id']}";
        $result = $conn->query($query_show);

        $arr = []; # associative array for the further fetch results
        while($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
        }

        # work log
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";

        include './header.php';
?>
<main class="container-fluid p-5">
    <div class="container">
        <h1>Your products</h1>
        <h4 class="text-success"><?= isset($_GET['msg']) ? filter_get("msg", $conn) : "" ?></h4>
        <a href="product-add.php">Add new product</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($arr as $item) : ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['price'] ?>$</td>
                    <td>
                        <a href="product-edit.php?editid=<?= $item['id'] ?>" class="badge bg-dark">Edit</a>
                        <a href="#" onclick="delProd(<?= $item['id'] ?>)" class="badge bg-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    const delProd = (id) => {
        if (confirm("Are you sure to delete the product?")) {
            window.location.href = "product-del.php?delid=" + id;
        }
    }
</script>
<?php include './footer.php' ?>
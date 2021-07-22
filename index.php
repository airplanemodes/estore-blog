<?php
    include_once './connect.php';
    include_once './util.php';
    include_once './header.php';

    $page_title = "Home";

    if ($user) {
        
        # SQL query assigning to the variable
        $query_for_pages = "SELECT COUNT(*) as total FROM products WHERE user_id = {$_SESSION['user_id']};";

        # '$conn' variable contains mysqli_connect function 
        # query() is a built-in method of that function
        $result_pages = $conn->query($query_for_pages); // SQL query sending
        $total = mysqli_fetch_assoc($result_pages); // fetching a result row as an associative array

        $per_page = 4;
        $total_pages = ceil($total["total"]/$per_page);
        $page = isset($_GET["page"]) ? ($_GET["page"] - 1) * $per_page : 0 ;

        $query = "SELECT * FROM products WHERE user_id = {$_SESSION['user_id']} LIMIT {$page}, {$per_page}";
        $result = $conn -> query($query);

        $arr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
        }
    
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
    }
?>
<main class="container-fluid p-5">
    <div class="container">
        <h1>Welcome</h1>
        <!-- if someone logged -->
        <?php if($user) : ?>
        <div class="d-flex fs-4">Pages:<?php for ($i = 0; $i < $total_pages; $i++) : ?>
            <a href="index.php?page=<?= $i+1 ?>" class="ms-2 mb-2 btn btn-dark"><?= $i+1 ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php if($user) : ?>
                <?php foreach ($arr as $item) : ?>
                    <div class="card col-lg-3 p-2 shadow">
                      <div class="card">
                        <div style="float:right; height:100px; background-image:url(<?= strlen($item['img_url']) > 4 ? $item['img_url'] : "https://cdn.pixabay.com/photo/2015/06/27/16/34/food-823607__340.jpg" ?>); background-size:cover; background-position:center;"></div>
                          <div class="card-body">
                            <h5 class="card-title"><?= $item['title'] ?></h5>
                            <p class="card-text"><?= $item['info'] ?></p>
                            <a href="#" class="btn btn-dark">Contact seller</a>
                          </div>
                      </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if(!$user) : ?>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ab excepturi totam deleniti at similique ametid est, hic, et nesciunt magni vero ea nostrum consequatur ad soluta nulla non ipsam nobis beatae asperioresrepellendus odio. Fugiat possimus, expedita sunt laudantium ratione, quos repellat autem in, officiis molestiaequi sapiente nemo quae obcaecati fugit. Quibusdam, omnis. Iure, nobis nulla. Atque dolor maxime unde nihilnumquam deserunt beatae dolorum harum laudantium fuga id, eveniet aut exercitationem cumque placeat. Culparatione quidem quas, repudiandae nobis optio aspernatur sequi, in officiis ad ipsam eveniet repellat deseruntillo quisquam, alias quasi odio obcaecati incidunt.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include './footer.php' ?>
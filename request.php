<?php
$url = "http://fs1.co.il/bus/shop.php";

$data_string = file_get_contents($url);
$json_array = json_decode(utf8_decode($data_string), true); # translates string into json

echo "<pre>";
print_r($json_array);
echo "</pre>";


echo $data_string;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Request test</title>
</head>
<body>
    <h1>List of products:</h1>
    <ul>
        <?php foreach($json_array as $item) : ?>
            <li><?= $item['name'] ?> - <?= $item['price'].".00" ?>NIS</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
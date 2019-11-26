<!DOCTYPE html>
<html>
<head>

    <title></title>
</head>
<body>
<?php 
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$sql = "select * from products";
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();


 ?>

 <ul>
    <?php 
    foreach ($resultSet as $row) {
        echo "<li>".
        $row["name"]. '--'.$row["price"]
        ."</li>";
    }

     ?>
 </ul>


</body>
</html>
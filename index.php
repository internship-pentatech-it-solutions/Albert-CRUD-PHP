<?php 
require_once "./includes/conn.php";

$query = "SELECT * FROM  products";
$stmt = $conn -> prepare($query);
$stmt -> execute();
$results = $stmt->fetchAll();

// print_r($results);

if (isset($_POST['submit'])){
    // print_r($_POST);

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (name,description,price) VALUES (:name,:description,:price)";
    $stmt = $conn -> prepare($query);
    $stmt -> bindParam(":name",$name);
    $stmt -> bindParam(":description",$description);
    $stmt -> bindParam(":price",$price);

    $stmt -> execute();

     // Redirect to avoid resubmission on refresh
     header("Location: " . $_SERVER['PHP_SELF']);
    echo "Data inserted successfully";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="index.php">HomePage</a>
            </li>
            |
            <li>
                <a href="employees.php">Employees Page</a>
            </li>
        </ul>
    </nav>

    <h1 class="title-text">E-Commerce Shop</h1>
    
<form action="" method="post"  class="body">
        <label for="name">
            Product Name
            <input type="text" name="name" id="name" required>
        </label>
        <br>
        <label for="description">
            Product Description
            <input type="text" name="description" id="description" required>
        </label>
        <br>
        <label for="price">
            Price
            <input type="number" name="price" id="price" required>
        </label>
        <input type="submit" name="submit" id="submit">
    </form>

    <div>
        <h1 class="title-text">Sample table</h1>
        <table class="body">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $id = 1;
                foreach ($results as $product){
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['description'] ?></td>
                    <td><?php echo $product['price'] ?></td>
                </tr>
                <?php $id++;} ?>
            </tbody>
        </table>
    </div>
</body>
</html>
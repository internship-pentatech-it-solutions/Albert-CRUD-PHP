<?php 
require_once "./includes/conn.php";

$query = "SELECT * FROM  employees";
$stmt = $conn -> prepare($query);
$stmt -> execute();
$results = $stmt->fetchAll();

// print_r($results);

if (isset($_POST['submit'])){
    // print_r($_POST);

    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $age = $_POST['age'];

    $query = "INSERT INTO employees (name,position,department,age) VALUES (:name,:position,:department,:age)";
    $stmt = $conn -> prepare($query);
    $stmt -> bindParam(":name",$name);
    $stmt -> bindParam(":position",$position);
    $stmt -> bindParam(":department",$department);
    $stmt -> bindParam(":age",$age);

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

    <h1 class="title-text">Employees</h1>
    
<form action="" method="post"  class="body">
        <label for="name">
             Name
            <input type="text" name="name" id="name" required>
        </label>
        <br>
        <label for="position">
             Position
            <input type="text" name="position" id="position" required>
        </label>
        <br>
        <label for="department">
             Department
            <input type="text" name="department" id="department" required>
        </label>
        <br>
        <label for="age">
            age
            <input type="number" name="age" id="age" required>
        </label>
        <input type="submit" name="submit" id="submit">
    </form>

    <div>
        <h1 class="title-text">Sample table</h1>
        <table class="body">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>age</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $id = 1;
                foreach ($results as $employee){
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $employee['Name'] ?></td>
                    <td><?php echo $employee['Position'] ?></td>
                    <td><?php echo $employee['Department'] ?></td>
                    <td><?php echo $employee['Age'] ?></td>
                </tr>
                <?php $id++;} ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<!-- <pre> -->
<?php 
//Pirmi DB sujungimai su PHP
//1. MySQLi
//1.1. Object-oriented
//1.2. Procedural

//2. PDO prisijungimas:

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "sakila";

try{
    $conn = new PDO("mysql:host=$serverName; dbname=$dbname", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to database";
} catch(PDOException $e){
    echo "Connection failed: ".$e->getMessage();
}

//traukiam duomenis iš "sakila" duomenų bazės:
//kintamojo paruosimas
// $sql = $conn->prepare("SELECT * FROM actor WHERE actor_id=1");

//Create Query (Prideti elementa)
$firstName = "JOHN";
$lastName = "WILLIS";

// $sql1 = "INSERT INTO actor(first_name, last_name) VALUES ('$firstName', '$lastName')";
// $query = $conn->prepare($sql1);
// $query->execute();


//Read Query
$sql = $conn->prepare("SELECT * FROM actor");

//uzklausos vykdymas
$sql->execute();
// var_dump($sql);

$result = $sql->fetchAll(); //fetch - traukia pirmaji elementa, fetchAll traukia visu elementu masyvus
// print_r($result);

// echo $result['first_name'];

//UPDATE
$id = 1;
$newName = "VARDAS";
$sql2 = "UPDATE actor SET first_name='$newName' WHERE actor_id=$id";
$query = $conn->prepare($sql2);
$query->execute();

//DELETE Query

$id = 206;
$sql3 = "DELETE FROM actor WHERE actor_id=$id";
$query = $conn->prepare($sql3);
$query->execute();



?>

<table>
    <tr>
        <th>Name</th>
        <th>Last Name</th>
    </tr>
    <?php
    foreach($result as $actor){
        echo "<tr><td>".$actor['first_name']."</td><td>".$actor['last_name']."</td></tr>";
    }
    ?>
</table>
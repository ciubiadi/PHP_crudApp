<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'php_crudapp') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$brand = '';
$model = '';

if(isset($_POST['save'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $mysqli->query("INSERT INTO car (brand, model) VALUES('$brand', '$model')") or
        die($mysqli->error());

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM car WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM car WHERE id=$id") or die($mysqli->error());
    if(count(array($result)) == 1){
        $row = $result->fetch_array();
        $brand = $row['brand'];
        $model = $row['model'];
    }
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $mysqli->query("UPDATE car SET brand='$brand', model='$model' WHERE id='$id'") or die($mysqli->error());

    $_SESSION['message'] = "REcord has been updated";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
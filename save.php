<?php
require_once "connectionimg.php";
$msg = "";
if (isset($_POST['upload'])) {
    $target = "./assets/img/" . md5(uniqid(time())) . basename($_FILES['image']['name']);
    $sql = "INSERT INTO imagini (cale_imagine) VALUES ('$target')";
    mysqli_query($con, $sql);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header('Location: incarcarefisiere.php');
    } else {
        $msg = "Vai! Vai! Vai!!!";
    }
}
?>



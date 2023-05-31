<?php
session_start();
$status=0;
include 'connection.php';
if(isset($_POST['register-button'])){
    $nume=$_POST['nume'];
    $pass=$_POST['password'];
    $usertype='utilizator';
    $query="SELECT * FROM koffee WHERE nume='{$nume}'";
    $result=mysqli_query($con,$query);
    if($result->num_rows>0){
        $status=1;
    }
    if($status==0){
        if($nume!=NULL && $pass!=NULL){
            $query="INSERT INTO koffee (nume, parola, utilizator) VALUES ('$nume','$pass','$usertype')";
            
            if(mysqli_query($con,$query)){
                echo '<script type="text/javascript">alert("New Account created. Please log in!")</script>';
                header('location:login.php');
            }
            else{
                echo "Error: ".$query."<br>".mysqli_error($con);
            }
        }
        else{
            echo '<script type="text/javascript">alert("introdu valori")</script>';
            header('location:registerform.php');
        }
        }
}
?>



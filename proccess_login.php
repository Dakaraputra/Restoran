<?php

session_start();
$conn = new mysqli("localhost","root","","login_db");
if ($conn->connect_error){
    die("Koneksi Gagal: ".$conn->connect_error);
}

$username=$_POST['username'];
$password=$_POST['password'];

$sql="select * from users where username = ?";
$stmt= $conn->prepare($sql);
$stmt-> bind_param("s",$username);
$stmt-> execute();
$result= $stmt->get_result();

if($result->num_rows>0){
    $user=$result->fetch_assoc();
    if(password_verify($password,$username['password'])){
        $_SESSION['username']=$user['username'];
        header("Location:welcome.php");
        exit();
    } else{
        echo "Password salah <a href='login.html'> Coba Lagi</a>";
    } 
}else {
        echo "user tidak ditemukan <a href='login.html'> Coba Lagi</a>";
    }
?>
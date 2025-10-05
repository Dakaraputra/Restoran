<?php
session_start();
//Ganti passwordnya sesuai my sql kalian
$conn = new mysqli("localhost", "root", "", "login_db");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query cek user
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Pastikan ada user
if ($result && $result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: welcome.php");
    exit();
} else {
    echo "Username atau Password salah! <a href='login.html'>Coba lagi</a>";
}

$conn->close();
?>


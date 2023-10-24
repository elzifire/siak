<?php
session_start();
include_once '../User.php';

// Periksa apakah pengguna yang masuk adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika bukan admin, redirect ke halaman lain atau tampilkan pesan error
    header("Location: 404.php"); // Ganti dengan halaman yang sesuai
    exit;
}

$user = new User();

// Inisialisasi variabel pesan kesalahan
$error_message = "";

// Tangani penambahan pengguna jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi data
    if (empty($username) || empty($password) || empty($role)) {
        $error_message = "Semua bidang harus diisi.";
    } else {
        // Coba menambahkan pengguna ke database
        if ($user->createUser($username, $password, $role)) {
            header("Location: lihat_user.php"); // Redirect ke halaman daftar pengguna setelah penambahan sukses
            exit;
        } else {
            $error_message = "Gagal menambahkan pengguna.";
        }
    }
}
?>

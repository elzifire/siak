<?php
session_start();
include_once '../User.php';

// Periksa apakah pengguna yang masuk adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika bukan admin, redirect ke halaman lain atau tampilkan pesan error
    header("Location: 404.php"); // Ganti dengan halaman yang sesuai
    exit;
}

if (isset($_GET['id'])) {
    $user = new User();
    $user_id = $_GET['id'];

    // Hapus pengguna dari database berdasarkan ID
    if ($user->deleteUser($user_id)) {
        header("Location: user-list.php"); // Redirect ke halaman daftar pengguna setelah penghapusan sukses
        exit;
    } else {
        echo "Gagal menghapus pengguna.";
    }
} else {
    echo "ID Pengguna tidak valid.";
}
?>

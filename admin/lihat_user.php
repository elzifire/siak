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
$users = $user->getUsers(); // Mengambil daftar pengguna dari database

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
</head>
<body>
    <h2>Daftar Pengguna</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['password']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="tambah_user.php">Tambah Pengguna</a>
</body>
</html>

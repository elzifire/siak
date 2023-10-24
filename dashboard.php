<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>Level akses: <?php echo $role; ?></h3>
        
    <?php if ($role === 'admin') { ?>
        <!-- Tampilkan konten admin di sini -->
        <ul>
            <li><a href="admin/lihat_user.php">Lihat User </a></li>
        </ul>
    <?php } elseif ($role === 'mahasiswa') { ?>
        <!-- Tampilkan konten mahasiswa di sini -->
        <ul>
            <li>Melihat Nilai</li>
        </ul>
    <?php } ?>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>

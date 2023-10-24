<?php 

include 'tambah_user_proses.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
</head>
<body>
    <h2>Tambah Pengguna</h2>
    <form method="POST" action="tambah_user_proses.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="mahasiswa">Mahasiswa</option>
        </select><br><br>
        <input type="submit" value="Tambah Pengguna">
    </form>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <br>
    <a href="lihat_user.php">Kembali ke Daftar Pengguna</a>
</body>
</html>

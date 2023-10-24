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

// Dapatkan ID pengguna yang akan diedit dari parameter URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Dapatkan informasi pengguna berdasarkan ID
    $user_info = $user->getUserById($user_id);

    if (!$user_info) {
        // Jika ID pengguna tidak ditemukan, redirect ke halaman daftar pengguna atau tampilkan pesan error
        header("Location: user-list.php"); // Ganti dengan halaman yang sesuai
        exit;
    }
} else {
    // Jika tidak ada ID yang diberikan, redirect ke halaman daftar pengguna atau tampilkan pesan error
    header("Location: user-list.php"); // Ganti dengan halaman yang sesuai
    exit;
}

// Tangani pengeditan pengguna jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi data
    if (empty($username) || empty($password) || empty($role)) {
        $error_message = "Semua bidang harus diisi.";
    } else {
        // Coba memperbarui pengguna dalam database
        if ($user->updateUser($user_id, $username, $password, $role)) {
            header("Location: user-list.php"); // Redirect ke halaman daftar pengguna setelah pengeditan sukses
            exit;
        } else {
            $error_message = "Gagal memperbarui pengguna.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<body>
    <h2>Edit Pengguna</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user_info['username']; ?>" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $user_info['password']; ?>" required><br><br>
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="admin" <?php if ($user_info['role'] === 'admin') echo 'selected'; ?>>Admin</option>
            <option value="mahasiswa" <?php if ($user_info['role'] === 'mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
        </select><br><br>
        <input type="submit" value="Simpan Perubahan">
    </form>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <br>
    <a href="user-list.php">Kembali ke Daftar Pengguna</a>
</body>
</html>

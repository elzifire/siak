<?php 
include_once 'conection.php';

class User {
    private $db;

    public function __construct()
    {
        $this->db = new Databases();
    }

    // ...
    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }

    public function getRole($username) {
        $query = "SELECT role FROM users WHERE username = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['role'];
        } else {
            return false;
        }
    }

    // Menambahkan pengguna (Create)
    public function createUser($username, $password, $role){
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("sss", $username, $password, $role);
        return $stmt->execute();
    }

    // Mendapatkan daftar pengguna (Read)
    public function getUsers(){
        $query = "SELECT * FROM users";
        $result = $this->db->conn->query($query);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getUserById($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1){
            $user = $result->fetch_assoc();
            return $user;
        }else{
            return false;
        }
    }
    

    // Memperbarui pengguna (Update)
    public function updateUser($id, $username, $password, $role){
        $query = "UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("sssi", $username, $password, $role, $id);
        return $stmt->execute();
    }

    // Menghapus pengguna (Delete)
    public function deleteUser($id){
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }


}
?>

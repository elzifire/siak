<?php 

class Databases {
    private $host = "localhost:3307";
    private $username = "root";
    private $password = "";
    private $database = "login";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if($this->conn->connect_error){
            die("koneksi gagal". $this->conn->connect_error);
        }else{
            echo "Berhasil terhubung";
        }
    }

}

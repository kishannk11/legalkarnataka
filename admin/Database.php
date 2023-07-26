<?php
class User {
    private $conn;
    private $table_name = "admin";
     public $id;
    public $username;
    public $password;
     public function __construct($db) {
        $this->conn = $db;
    }
     public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
         if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                 if (isset($_POST['remember_me'])) {
                    setcookie("username", $this->username, time() + (86400 * 30), "/");
                    setcookie("password", $this->password, time() + (86400 * 30), "/");
                }
                 return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

class MainCategory {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function addMainCategory($mainCategory) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO main_category (name) VALUES (:mainCategory)");
            $stmt->bindParam(':mainCategory', $mainCategory, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getMainCategories() {
        $categories = array();
    
        $sql = "SELECT id, name FROM main_category";
        $result = $this->conn->query($sql);
    
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
        }
    
        return $categories;
    }
}

class SubCategory {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function addSubCategory($name, $parentCategory) {
        // Sanitize and validate input to prevent SQL injection and other security vulnerabilities
        $name = $this->sanitizeInput($name);
        $parentCategory = $this->sanitizeInput($parentCategory);
        
        // Prepare the SQL statement
        $sql = "INSERT INTO sub_category (name, parent_category) VALUES (:name, :parentCategory)";
        $stmt = $this->conn->prepare($sql);
        
        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':parentCategory', $parentCategory);
        
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    private function sanitizeInput($input) {
        // Sanitize the input using appropriate sanitization functions or techniques
        // For example, you can use htmlspecialchars() or mysqli_real_escape_string() functions
        $sanitizedInput = htmlspecialchars($input);
        return $sanitizedInput;
    }
}
?>
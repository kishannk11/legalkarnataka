<?php
class User
{
    private $conn;
    private $table_name = "admin";
    public $id;
    public $username;
    public $password;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function login()
    {
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

class MainCategory
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addMainCategory($mainCategory)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO main_category (name) VALUES (:mainCategory)");
            $stmt->bindParam(':mainCategory', $mainCategory, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getMainCategories()
    {
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

class SubCategory
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addSubCategory($name, $parentCategory)
    {
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

    private function sanitizeInput($input)
    {
        // Sanitize the input using appropriate sanitization functions or techniques
        // For example, you can use htmlspecialchars() or mysqli_real_escape_string() functions
        $sanitizedInput = htmlspecialchars($input);
        return $sanitizedInput;
    }
}

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveProduct($prod_name, $category, $price, $details, $image)
    {
        // Sanitize the input data
        $prod_name = $this->sanitizeInput($prod_name);
        $category = $this->sanitizeInput($category);
        $price = $this->sanitizeInput($price);
        $details = $this->sanitizeInput($details);

        // Validate and process the image file
        $imagePath = $this->processImage($image);

        // Check if any field is empty
        if (empty($prod_name) || empty($category) || empty($price) || empty($details) || empty($imagePath)) {
            return 'Please fill in all the fields.';
        }

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO products (prod_name, category, price, details, image) VALUES (?, ?, ?, ?, ?)");

        // Bind the parameters
        $stmt->bindParam(1, $prod_name);
        $stmt->bindParam(2, $category);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $details);
        $stmt->bindParam(5, $imagePath);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to product-add.php
            return true;
        } else {
            return 'Error saving the product.';
        }
    }

    private function sanitizeInput($input)
    {
        // Sanitize the input using appropriate sanitization functions
        $sanitizedInput = trim($input);
        $sanitizedInput = stripslashes($sanitizedInput);
        $sanitizedInput = htmlspecialchars($sanitizedInput);
        return $sanitizedInput;
    }

    private function processImage($image)
    {
        // Check if a file is uploaded
        if (!isset($image['tmp_name']) || empty($image['tmp_name'])) {
            return '';
        }

        // Check if the file format is valid
        $allowedFormats = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedFormats)) {
            return '';
        }

        // Generate a unique filename for the image
        $filename = uniqid() . '.' . $fileExtension;

        // Move the uploaded file to the desired directory
        $targetDir = 'upload/';
        $targetFile = $targetDir . $filename;
        move_uploaded_file($image['tmp_name'], $targetFile);

        return $filename;
    }
    public function getProduct()
    {
        $product = array();

        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $product[] = $row;
            }
        }

        return $product;
    }

    public function deleteProduct($productId)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bindParam(1, $productId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
?>
<?php
class Admin
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
                $_SESSION["email"] = $row["email"];
                $_SESSION["role"] = $row["role"];

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getAdminInfo()
    {
        $sql = "SELECT * FROM admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin;

    }
    public function updateAdmin($data)
    {
        $sql = "UPDATE admin SET  
            name = :name,  
            email = :email,
            password = :password,
            image = :image  
            WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $data['id']);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAdminWithoutPassword($data)
    {
        $sql = "UPDATE admin SET  
        name = :name,  
        email = :email,
        image = :image  
        WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $data['id']);

        // Execute query
        if ($stmt->execute()) {
            return true;
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
    public function deleteMain($Id)
    {
        $stmt = $this->conn->prepare("DELETE FROM main_category WHERE id = ?");
        $stmt->bindParam(1, $Id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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
    public function getSubCategories()
    {
        $categories = array();

        $sql = "SELECT * FROM sub_category";
        $result = $this->conn->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
        }

        return $categories;
    }
    public function getOneSubCategories($id)
    {
        $categories = array();

        $sql = "SELECT * FROM sub_category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
        }

        return $categories;
    }
    public function updateSubCategory($id, $name, $parentCategory)
    {
        $sql = "UPDATE sub_category SET name = :name, parent_category = :parentCategory WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':parentCategory', $parentCategory);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveProduct($prod_name, $category, $price, $details, $image, $optgroup)
    {
        // Sanitize the input data
        $prod_name = $this->sanitizeInput($prod_name);
        $category = $this->sanitizeInput($category);
        $price = $this->sanitizeInput($price);
        $details = $this->sanitizeInput($details);
        $optgroup = $this->sanitizeInput($optgroup);

        // Validate and process the image file
        $imagePath = $this->processImage($image);

        // Check if any field is empty
        if (empty($prod_name) || empty($category) || empty($price) || empty($details) || empty($imagePath)) {
            return 'Please fill in all the fields.';
        }

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO products (prod_name, category,main_category, price, details, image) VALUES (?, ?, ?, ?, ?,?)");

        // Bind the parameters
        $stmt->bindParam(1, $prod_name);
        $stmt->bindParam(2, $category);
        $stmt->bindParam(3, $optgroup);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $details);
        $stmt->bindParam(6, $imagePath);

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



    public function getProductData($id)
    {
        $productData = array();

        // Retrieve data from products_template table
        $productSql = "SELECT template_id FROM product_templates WHERE prod_name = :prod_name";
        $productStmt = $this->conn->prepare($productSql);
        $productStmt->bindParam(':prod_name', $id);
        $productStmt->execute();
        $productData = $productStmt->fetchAll(PDO::FETCH_ASSOC);

        if ($productData) {
            foreach ($productData as &$product) {
                // Retrieve data from form_templates table using template_id
                $templateSql = "SELECT template_fields FROM form_templates WHERE id = :Id";
                $templateStmt = $this->conn->prepare($templateSql);
                $templateStmt->bindParam(':Id', $product['template_id']);
                $templateStmt->execute();
                $templateData = $templateStmt->fetch(PDO::FETCH_ASSOC);

                if ($templateData) {
                    $product['template_fields'] = $templateData;
                }
            }
        }

        return $productData;
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
    public function getProductwithId($id)
    {
        $product = array();

        $sql = "SELECT * FROM products where id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product[] = $row;
            }
        }

        return $product;
    }


}

class Templates
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveTemplate($templateName, $templateFields)
    {
        // Validate the template name and fields
        if (empty($templateName)) {
            return "Template name is required.";
        }

        if (empty($templateFields)) {
            return "Template fields are required.";
        }
        $stmt = $this->conn->prepare("INSERT INTO form_templates (template_name, template_fields) VALUES (?, ?)");
        $stmt->bindParam(1, $templateName);
        $stmt->bindParam(2, $templateFields);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error saving the template: " . $e->getMessage();
        }
    }

    public function getAllTemplates()
    {
        $stmt = $this->conn->query("SELECT * FROM form_templates");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteTemplate($templatetId)
    {
        $stmt = $this->conn->prepare("DELETE FROM form_templates WHERE id = ?");
        $stmt->bindParam(1, $templatetId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTemplatebyID($id)
    {
        $template = array();

        $sql = "SELECT * FROM form_templates WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $template = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $template;
    }

    public function updateTemplate($templateName, $templateFields, $id)
    {
        $stmt = $this->conn->prepare("UPDATE form_templates SET template_name = ?, template_fields = ? WHERE id = ?");
        $stmt->bindParam(1, $templateName);
        $stmt->bindParam(2, $templateFields);
        $stmt->bindParam(3, $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error updating the template: " . $e->getMessage();
        }
    }


    public function saveProdTemplate($prodName, $selectedIDs)
    {
        // Sanitize and validate input if needed
        $prodName = $this->sanitizeInput($prodName);

        // Convert $selectedIDs to an array if it's a string
        if (!is_array($selectedIDs)) {
            $selectedIDs = [$selectedIDs];
        }

        $selectedIDs = array_map([$this, 'sanitizeInput'], $selectedIDs);

        // Prepare the SQL statement
        $sql = "INSERT INTO product_templates (prod_name, template_id) VALUES (:prodName, :templateID)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':prodName', $prodName);

        // Execute the statement for each selected ID
        foreach ($selectedIDs as $templateID) {
            $stmt->bindParam(':templateID', $templateID);
            $stmt->execute(); // Execute the statement

            if ($stmt->rowCount() === 0) {
                return false; // Return false if the execution fails
            }
        }

        return true; // Return true if all executions are successful
    }
    private function sanitizeInput($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    public function getProductTemplates()
    {
        $stmt = $this->conn->query("SELECT prod_name,template_id FROM product_templates");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;


    }
    public function getTemplate($ids)
    {

        $stmt = $this->conn->prepare('SELECT * FROM form_templates WHERE id IN (' . implode(',', $ids) . ')');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}

class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerUser($firstname, $lastname, $email, $phonenumber, $password)
    {
        // Check if the user is already registered
        $role = "client";
        $image = "test";
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email OR phonenumber = :phonenumber";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phonenumber', $phonenumber);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; // User is already registered
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement
        $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password,role,image) VALUES (:firstname, :lastname, :email, :phonenumber, :password, :role, :image)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phonenumber', $phonenumber);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':image', $image);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // User is successfully registered
        } else {
            return false; // Failed to register user
        }
    }
    public function loginUser($email, $password)
    {
        // Sanitize and validate input to prevent SQL injection and other security vulnerabilities
        $email = $this->sanitizeInput($email);
        $password = $this->sanitizeInput($password);
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            return true;
        } else {
            return false;
        }
    }
    private function sanitizeInput($input)
    {
        $sanitizedInput = htmlspecialchars($input);
        return $sanitizedInput;
    }
    public function getAllEmployees()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $employees;
    }
    public function getUserByPhone($phone)
    {
        $sql = "SELECT * FROM users WHERE phonenumber = :phone";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function deleteUser($usertId)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindParam(1, $usertId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserInfo($userId)
    {
        $sql = "SELECT * FROM users WHERE id= ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $userId);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;

    }
    public function updateUser($data)
    {
        $sql = "UPDATE users SET  
            firstname = :firstname,
            lastname = :lastname,  
            email = :email,
            password = :password,
            phonenumber=:phonenumber,
            image = :image  
            WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':phonenumber', $data['phonenumber']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $data['id']);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUserWithoutPassword($data)
    {
        $sql = "UPDATE users SET  
        firstname = :firstname,
        lastname = :lastname,  
        email = :email,
        phonenumber=:phonenumber,
        image = :image  
        WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phonenumber', $data['phonenumber']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $data['id']);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

?>
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
    public function deleteSub($Id)
    {
        $stmt = $this->conn->prepare("DELETE FROM sub_category WHERE id = ?");
        $stmt->bindParam(1, $Id);

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

    public function saveProduct($prod_name, $category, $price, $details, $images, $optgroup)
    {
        // Sanitize the input data
        $prod_name = $this->sanitizeInput($prod_name);
        $category = $this->sanitizeInput($category);
        $price = $this->sanitizeInput($price);
        $details = $this->sanitizeInput($details);
        $optgroup = $this->sanitizeInput($optgroup);

        // Check if any field is empty
        if (empty($prod_name) || empty($category) || empty($price) || empty($details) || empty($images)) {
            return 'Please fill in all the fields.';
        }

        // Process and save the image files
        $imageNames = $this->processImages($images);


        // Prepare the SQL statement for inserting product details
        $stmt = $this->conn->prepare("INSERT INTO products (prod_name, category, main_category, price, details) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $prod_name);
        $stmt->bindParam(2, $category);
        $stmt->bindParam(3, $optgroup);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $details);
        $stmt->execute();

        // Get the last inserted product ID
        $productId = $this->conn->lastInsertId();

        // Prepare the SQL statement for inserting image file names
        $imageStmt = $this->conn->prepare("INSERT INTO product_images (product_id, image_name) VALUES (?, ?)");
        foreach ($imageNames as $imageName) {
            $imageStmt->bindParam(1, $productId, PDO::PARAM_INT);
            $imageStmt->bindParam(2, $imageName, PDO::PARAM_STR);
            $imageStmt->execute();
        }

        return true;
    }

    private function sanitizeInput($input)
    {
        // Sanitize the input using appropriate sanitization functions
        $sanitizedInput = trim($input);
        $sanitizedInput = stripslashes($sanitizedInput);
        $sanitizedInput = htmlspecialchars($sanitizedInput);
        return $sanitizedInput;
    }


    private function processImages($images)
    {
        // Check if a file is uploaded
        if (!isset($images['tmp_name']) || empty($images['tmp_name'])) {
            return [];
        }
        // Check if the file format is valid
        $allowedFormats = ['jpg', 'jpeg', 'png'];
        $imageNames = [];
        foreach ($images['tmp_name'] as $key => $tmpName) {
            $fileExtension = strtolower(pathinfo($images['name'][$key], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedFormats)) {
                continue; // Skip invalid file formats
            }
            // Generate a unique filename for the image
            $filename = uniqid() . '.' . $fileExtension;
            // Move the uploaded file to the desired directory
            $targetDir = 'upload/';
            $targetFile = $targetDir . $filename;
            move_uploaded_file($tmpName, $targetFile);
            $imageNames[] = $filename;
        }
        return $imageNames;
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

    public function getProductImage($id)
    {
        $imageNames = array();
        $stmt = $this->conn->prepare("SELECT image_name FROM product_images WHERE product_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imageNames[] = $row['image_name'];
            }
        }
        return $imageNames;
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

    public function getPreview($id)
    {
        $product = array();

        $sql = "SELECT * FROM preview_data where order_id=?";
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
            $_SESSION['id'] = $user['id'];
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

    public function getUserByEmail($phone)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $phone);
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
class Payment
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveTransaction($txnid, $amount, $status, $prodids, $orderid)
    {
        try {
            $sql = "INSERT INTO transactions (txnid, amount, status, prod_id, order_id) VALUES (:txnid, :amount, :status, :prod_id, :order_id)";
            $stmt = $this->conn->prepare($sql);

            // Convert the comma-separated values of $prodids to an array
            $prodidsArray = explode(',', $prodids);

            foreach ($prodidsArray as $prodid) {
                $stmt->bindParam(':txnid', $txnid);
                $stmt->bindParam(':amount', $amount);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':prod_id', $prodid);
                $stmt->bindParam(':order_id', $orderid);
                $stmt->execute();
            }

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveOrder($firstname, $lastname, $address, $city, $postalcode, $state, $order, $email, $productIds, $price)
    {
        // Validate and sanitize the input data
        $firstname = filter_var($firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $address = filter_var($address, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $city = filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $postalcode = filter_var($postalcode, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $state = filter_var($state, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Convert the comma-separated values of $productIds to an array
        $productIdsArray = explode(',', $productIds);

        // Insert the order details into the order_details table for each product ID
        foreach ($productIdsArray as $productId) {
            $sql = "INSERT INTO order_details (firstname, lastname, address, city, postalcode, state, order_id, email, prod_id, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $firstname);
            $stmt->bindParam(2, $lastname);
            $stmt->bindParam(3, $address);
            $stmt->bindParam(4, $city);
            $stmt->bindParam(5, $postalcode);
            $stmt->bindParam(6, $state);
            $stmt->bindParam(7, $order);
            $stmt->bindParam(8, $email);
            $stmt->bindParam(9, $productId);
            $stmt->bindParam(10, $price);
            if (!$stmt->execute()) {
                // Error occurred while saving the order
                echo "Error: " . $stmt->errorInfo()[2];
                return false;
            }
        }
    }
    public function getOrderDetails()
    {
        $orderDetails = array();

        $sql = "SELECT * FROM order_details";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orderDetails;
    }
    public function getOrderDetailsbyID($id)
    {
        $orderDetails = array();
        $sql = "SELECT * FROM order_details WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $id);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orderDetails;
    }
    public function getOrderDetailsbyOrderID($id)
    {
        $orderDetails = array();
        $sql = "SELECT * FROM order_details WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $id);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orderDetails;
    }

    public function getOrderFiles($orderid)
    {
        $orderDetails = array();

        $sql = "SELECT * FROM files WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderid);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orderDetails;
    }
    public function getPreviewData($orderid)
    {
        $orderDetails = array();

        $sql = "SELECT label,value FROM preview_data WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderid);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orderDetails;
    }
    public function savePdfToDb($order_id, $email, $pdf_name)
    {
        $sql = "INSERT INTO pdf_details (order_id, email, pdf_name) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters and execute the statement
        $stmt->bindValue(1, $order_id);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $pdf_name);

        $stmt->execute();
    }
    function saveSoftcopy($orderId, $email, $file)
    {

        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = $file['name'];
            $fileTmpPath = $file['tmp_name'];

            $uploadDir = 'upload/';
            $uploadPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $sql = "INSERT INTO softcopy (orderid, email, filename) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $orderId);
                $stmt->bindValue(2, $email);
                $stmt->bindValue(3, $fileName);
                $stmt->execute();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

class Cart
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addToCart($productId, $price, $email, $StamPrice)
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO cart (product_id, price, email,stamp_price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(1, $productId);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $StamPrice);

        // Execute the statement
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getCartDetails($email)
    {
        $sql = "SELECT * FROM cart WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $cartDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cartDetails;
    }
    public function removeAllCartItems()
    {
        $sql = "DELETE FROM cart";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Optional: Check if the delete operation was successful
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>